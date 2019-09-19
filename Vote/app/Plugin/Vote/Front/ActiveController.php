<?php

namespace App\Plugin\Vote\Front;

use App\Plugin\Vote\Models\Active;
use App\Plugin\Vote\Models\ActivePrize;
use App\Plugin\Vote\Models\ActiveTimes;
use App\Plugin\Vote\Models\Prize;
use App\Plugin\Vote\Models\User;
use App\Plugin\Vote\Models\Vote;
use App\Plugin\Vote\Models\VoteConfig;
use App\Plugin\Vote\Models\WxMerchant;
use App\Services\WeiXinServices;
use Illuminate\Http\Request;


class ActiveController extends BaseController
{
    protected $token;
    protected $config;
    protected $merchant;//商户
    protected $isResponse = 0;
    public $sessionName = '';
    public $relInfo;
    public $relModel;//是否关联
    public $relModelId;//是否关联
    public $openid;
    public $template;//配置信息
    public $user;
    public $rel;

    public function __construct(Request $request)
    {

        parent::__construct();

        $this->routeInfo($this->module);
        $this->token = $request->token;
        $merchant_id = $request->merchant;
        $this->rel = $request->rel;
        $this->relInfo = $request->rel ? explode('_', $request->rel) : [];//关联

        $this->merchant = WxMerchant::find($merchant_id);
        $this->config = Active::where('token', $this->token)->first();

        //必须写在中间件认证之后的下面，才能有效,
        $this->middleware(function ($request, $next) {


            if (empty($this->config) || empty($this->merchant)) {
                $this->isResponse = 1;
                return $this->error('不存在', '请确认链接地址是否正确');
            }
            $this->sessionName = 'active_session_' . $this->config->id;
            //如果关联，判断openid是否存在，如果不存在则需要返回上次
            if (!empty($this->relInfo)) {
                $this->relModel = $this->relInfo[0];
                $this->relModelId = $this->relInfo[1];

                $this->user = session('active_user');
                $openid = $this->user['openid'];
                if (empty($openid)) {
                    $this->isResponse = 1;
                    return $this->error('缺少数据', '请返回上一步操作');
                }
                $this->user = User::find($this->user['id']);

            } else {
                $this->user = session($this->sessionName);
            }

            return $next($request);

        });

    }

    //取得项目的URL
    public function getUrl()
    {
        $data=['merchant' => $this->merchant, 'token' => $this->token ];
        if($this->rel)
        {
            $data['rel'] = $this->rel;
        }
        return plugin_route('vote.active.index', $data);
    }

    public function index()
    {

        $request = request();
        $self_url = $this->getUrl();
        $user = '';
        //不存在关联，则进行授权登录
        if (!$this->rel) {
            if (!env('WXDEMO')) {
                $session_info = session($this->sessionName);

                if ($session_info) {


                    $openid = $session_info['openid'];
                } else {
                    $wx_user='';
                    //进来就发起授权
                    WeiXinServices::config($this->merchant->app_id, $this->merchant->app_secret);
                    try {
                        //取得授权用户
                        $wx_user = WeiXinServices::getUser()->toArray();

                    } catch (\Exception $exception) {

                    }
                    //如果不存在发起授权
                    if (!$wx_user) {
                        //发起授权
                        return WeiXinServices::auth($self_url);
                    }

                    $session_data = [
                        'openid' => $wx_user['id'],
                        'nickname' => $wx_user['nickname'],
                        'avatar' => $wx_user['avatar']
                    ];

                    $openid = $session_data['openid'];
                    //存入

                    //会员入库
                    $user = $this->user = User::createOrGetModel($session_data['openid'], $this->merchant->id, 'active', $this->config->id, $session_data['nickname'], $session_data['avatar']);
                    $request->session()->put($this->sessionName, $user->toArray());
                }
            } else {

                $openid = 'xxx1232323236644422224545334411' . mt_rand(1, 999);
            }

            //判断用户是否存在，如果存在则不添加
            if (!$user) {
                $user = User::createOrGetModel($openid, $this->merchant->id, 'active', $this->config->id);
            }
            //赋值
            $this->user = $user;

        }

        //写入session
        session([$this->sessionName => $this->user->toArray()]);

        $this->activeType();
        $self_url = $this->getUrl();
        //相关链接，修改分享地址
        if ($this->rel) {
            $vote = VoteConfig::find($this->relModelId);

            $self_url = plugin_route('vote.vote.index', ['merchant' => $vote->wx_merchant_id, 'token' => $this->token]);
        }

        //取得活动次数
        $has_time = ActiveTimes::getTime($this->user['id'], $this->config->day_number_type == 1 ? 1 : 0, 'active', $this->config->id);


        $data = [

            'user' => $this->user,
            'token' => $this->config->token,
            'merchant' => $this->merchant,
            'tpl' => $this->template,
            'config' => $this->config,
            'end' => strtotime($this->config->end_at) <= time() ? 1 : 0,
            'start' => strtotime($this->config->start_at) >= time() ? 0 : 1,
            'has_times' => $this->config->day_number <= $has_time ? 0 : $this->config->day_number - $has_time,
            'prize_msg' => $this->config->prize_msg,
            'intro_msg' => $this->config->intro_msg,
            'user_prize' => $this->getUserPrize($this->user['id']),
            'rel' => $this->rel,
            'self_url'=>$self_url,
            'wxshare' => [
                'title' => $this->config->wx_share_title,
                'url' => $self_url,
                'desc' => $this->config->wx_share_desc,
                'ico' => picurl($this->config->wx_share_ico),
            ],
            'title' => $this->config['name']
        ];
        return $this->display($data);
    }

    //奖品
    public function prize()
    {
        $prize = Prize::where('active_id', $this->config->id)->get();
        return $prize;
    }

    //取得奖品
    public function getUserPrize($user_id)
    {
        //
        $prizes = ActivePrize::where(['active_id' => $this->config->id, 'user_id' => $user_id])->get();

        return $prizes;
    }

    /**
     * 插件类型配置
     */
    public function activeType()
    {

        $arr = [];
        switch ($this->config->type) {
            //大转盘
            case 'dazhuanpan':
                $arr['template'] = plugin_res('/vote/front/active/dzp/images/prize' . $this->config->prize_level . '.png');
                $arr['css_guide'] = plugin_res('/vote/front/active/dzp/images/guide.png');
                $arr['bg'] = plugin_res('/vote/front/active/dzp/images/css_bg.jpg');
                break;
        }
        $this->template = $arr;
    }

    //取得插件奖项
    public function getActvePrize($data)
    {
        //中奖
        $level = count($data);//奖品级别

        $prize_arr = [];
        //不中奖总数
        //概率
        $ratio = $this->config['prize_ratio'];

        $gl = 100 * $ratio;//概率，万人，百万，10万
        $ratio_total = 0;

        foreach ($data as $k => $v) {

            $level_num = "number";
            $level_name = "name";
            $level_gl = "ratio";
            $prize_arr[] = [
                'id' => $k, 'prize' => $v[$level_name], 'v' => $v['ratio'] * $ratio, 'number' => $v[$level_num], 'is_prize' => 1
            ];

            $ratio_total += ($v[$level_gl] * $ratio);
        }

        $prize_nototal = round($gl - $ratio_total, 0);
        switch ($level) {
            case "3":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 60;
                $prize_arr[1]['min'] = 120;
                $prize_arr[1]['max'] = 180;
                $prize_arr[2]['min'] = 240;
                $prize_arr[2]['max'] = 300;
                $prize_arr[3] = [
                    'id' => 4, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [60, 180, 300], 'max' => [120, 240, 360]
                ];

                break;
            case "4":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 45;
                $prize_arr[1]['min'] = 180;
                $prize_arr[1]['max'] = 225;
                $prize_arr[2]['min'] = 90;
                $prize_arr[2]['max'] = 135;
                $prize_arr[3]['min'] = 270;
                $prize_arr[3]['max'] = 315;
                $prize_arr[4] = [
                    'id' => 5, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [45, 135, 225, 315], 'max' => [90, 180, 270, 360]
                ];

                break;
            case "5":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 36;
                $prize_arr[1]['min'] = 72;
                $prize_arr[1]['max'] = 108;
                $prize_arr[2]['min'] = 144;
                $prize_arr[2]['max'] = 180;
                $prize_arr[3]['min'] = 216;
                $prize_arr[3]['max'] = 252;
                $prize_arr[4]['min'] = 288;
                $prize_arr[4]['max'] = 324;
                $prize_arr[5] = [
                    'id' => 6, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [36, 108, 180, 252, 324], 'max' => [72, 144, 216, 288, 360]
                ];

                break;
            case "6":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 30;
                $prize_arr[1]['min'] = 60;
                $prize_arr[1]['max'] = 90;
                $prize_arr[2]['min'] = 120;
                $prize_arr[2]['max'] = 150;
                $prize_arr[3]['min'] = 180;
                $prize_arr[3]['max'] = 210;
                $prize_arr[4]['min'] = 240;
                $prize_arr[4]['max'] = 270;
                $prize_arr[5]['min'] = 300;
                $prize_arr[5]['max'] = 330;
                $prize_arr[6] = [
                    'id' => 7, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [30, 90, 150, 210, 270, 330], 'max' => [60, 120, 180, 240, 300, 360]
                ];

                break;
            case "7":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 20;
                $prize_arr[1]['min'] = 60;
                $prize_arr[1]['max'] = 90;
                $prize_arr[2]['min'] = 120;
                $prize_arr[2]['max'] = 150;
                $prize_arr[3]['min'] = 180;
                $prize_arr[3]['max'] = 210;
                $prize_arr[4]['min'] = 240;
                $prize_arr[4]['max'] = 270;
                $prize_arr[5]['min'] = 300;
                $prize_arr[5]['max'] = 330;

                $prize_arr[6]['min'] = 330;
                $prize_arr[6]['max'] = 360;

                $prize_arr[7] = [
                    'id' => 8, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [30, 90, 150, 210, 270], 'max' => [60, 120, 180, 240, 300]
                ];

                break;
            case "8":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 20;
                $prize_arr[1]['min'] = 60;
                $prize_arr[1]['max'] = 90;
                $prize_arr[2]['min'] = 120;
                $prize_arr[2]['max'] = 150;
                $prize_arr[3]['min'] = 180;
                $prize_arr[3]['max'] = 210;
                $prize_arr[4]['min'] = 240;
                $prize_arr[4]['max'] = 270;
                $prize_arr[5]['min'] = 300;
                $prize_arr[5]['max'] = 330;

                $prize_arr[6]['min'] = 330;
                $prize_arr[6]['max'] = 360;
                $prize_arr[7]['min'] = 150;
                $prize_arr[7]['max'] = 180;

                $prize_arr[8] = [
                    'id' => 9, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [30, 90, 210, 270], 'max' => [60, 120, 240, 300]
                ];

                break;
            case "9":
                $prize_arr[0]['min'] = 0;
                $prize_arr[0]['max'] = 20;
                $prize_arr[1]['min'] = 60;
                $prize_arr[1]['max'] = 90;
                $prize_arr[2]['min'] = 120;
                $prize_arr[2]['max'] = 150;
                $prize_arr[3]['min'] = 180;
                $prize_arr[3]['max'] = 210;
                $prize_arr[4]['min'] = 240;
                $prize_arr[4]['max'] = 270;
                $prize_arr[5]['min'] = 300;
                $prize_arr[5]['max'] = 330;

                $prize_arr[6]['min'] = 330;
                $prize_arr[6]['max'] = 360;
                $prize_arr[7]['min'] = 150;
                $prize_arr[7]['max'] = 180;
                $prize_arr[8]['min'] = 270;
                $prize_arr[8]['max'] = 300;

                $prize_arr[9] = [
                    'id' => 10, 'prize' => "谢谢参与", 'v' => $prize_nototal, 'number' => 0, 'is_prize' => 0, 'min' => [30, 90, 210], 'max' => [60, 120, 240]
                ];

                break;
        }

        return $prize_arr;

    }

    /**
     * 数据中奖数据
     * @param $prize_array
     * @return int|string
     */
    public function getRandomChance($prize_array)
    {
        $result = '';

        //概率数组的总概率精度
        $proSum = array_sum($prize_array);

        //概率数组循环
        foreach ($prize_array as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);

        return $result;
    }

    //查询中奖数量
    public function getPrizeNumber($level)
    {
        //加锁了，排他锁
        $total = Prize::where('active_id', $this->config->id)
            ->where('level', $level)->lockForUpdate()->count();
        return $total;
    }

    //中奖写入
    public function addUserPrize($data)
    {
        $prize = ActivePrize::create($data);
        return $prize;

    }

    //查询是否获奖
    public function lottery($merchant, $token, $rel = '', Request $request)
    {
        $user = $this->user;

        //检测内容：（1）已中奖不能再中奖检测，（2）中奖次数用完，（3）活动结束检测
        $user_id = $user['id'];
        //数据初始化
        $openid = $this->user['openid'];

        //是否过期

        //是否还没开始
        if (strtotime($this->config->start_at) > time()) {
            return $this->returnErrorApi('活动还没开始');
        }

        if (strtotime($this->config->end_at) <= time()) {
            return $this->returnErrorApi('活动已经结束');
        }

        //取得会员数据

        if (!$user) {
            return $this->returnErrorApi('会员不存在');
        }
        if (!$openid) {
            return $this->returnErrorApi('缺少数据');
        }
        //奖品奖项
        $prize = Prize::where('active_id', $this->config->id)->orderBy('level', 'asc')->get()->toArray();

        if (empty($prize)) {
            return $this->returnErrorApi('奖品没有设置');
        }
        //已经中奖不能再中
        if ($this->config['prize_type'] == 1) {
            $has_prize = ActivePrize::where([
                'wx_merchant_id' => $this->merchant->id,
                'openid' => $openid,
                'active_id' => $this->config->id

            ])->count();
            if ($has_prize > 0) {
                return $this->returnErrorApi('已经中奖过，不能再中奖');
            }
        }

        //取得抽奖次数
        //判断是否一次性抽奖
        $day_date = 0;
        if ($this->config->day_number_type == 1) {

            //每天抽奖次数
            $day_date = 1;

        }
        //每天抽奖次数
        $play_time = $this->config->day_number;

        //取得已经抽奖的次数
        $play_has_time = ActiveTimes::getTime($user_id, $day_date, 'active', $this->config->id);

        //抽奖次数小于已经玩的次数
        if ($play_has_time >= $play_time) {
            return $this->returnErrorApi($this->config->over_msg ?: '抽奖次数用完');
        }

        $prize = array_to_key($prize, 'level');

        //奖品概率设置
        $prize_arr = $this->getActvePrize($prize);

        $rand_arr = [];
        foreach ($prize_arr as $key => $val) {
            $rand_arr[$val['id']] = $val['v'];
        }

        $rid = $this->getRandomChance($rand_arr); //根据概率获取奖项id

        $prize_res = $prize_arr[$rid - 1]; //中奖项

        //原来中奖数据
        $origin_level = $prize_res;

        /*-----------------中奖数量在这里处理--------------------*/
        if ($prize_res['is_prize'] == 1) {
            //后续再加入队列
            $prize_level_total = $this->getPrizeNumber($prize_res['id']);

            //大于奖品数量就谢谢参与
            if ($prize_level_total >= $prize_res['number']) {
                //取得最后一个奖品
                $prize_res = $prize_arr[count($prize_arr) - 1];
            } else {
                //中奖加入中奖项
                $prize_user_data = [
                    'wx_merchant_id' => $this->merchant->id,
                    'active_id' => $this->config->id,
                    'user_id' => $user_id,
                    'openid' => $openid,
                    'prize' => $prize_res['prize'],
                    'level' => $prize_res['id'],
                    'name' => $user['username'] ?: $user['nickname'],
                    'phone' => $user['phone'] ?? '',
                    'thumb' => $user['header_pic'],
                    'active_name' => $this->config->name,

                ];
                //写入失败，直接返回谢谢参与
                if (!$this->addUserPrize($prize_user_data)) {
                    $prize_res = $prize_arr[count($prize_arr) - 1];
                }
            }
        }
        /*-----------end中奖数量在这里处理----------*/

        $min = $prize_res['min'];
        $max = $prize_res['max'];

        if ($prize_res['is_prize'] == 0) { //谢谢参与

            $i = mt_rand(0, count($prize_res['min']) - 1);
            $result['angle'] = mt_rand($min[$i] + 5, $max[$i] - 10);
            $result['has_win'] = 0;
            $result['prize'] = $prize_res['prize'];
        } else {
            $result['angle'] = mt_rand($min + 5, $max - 10); //随机生成一个角度
            $result['has_win'] = 1;
            $result['prize'] = $prize_res['prize'];

        }
        $result['reslut'] = $prize_res;
        $result['level'] = $prize_res['id'];
        $result['number'] = $prize_res['number'];
        $result['origin_level'] = $origin_level;
        //数字转换
        $level_name = [
            '1' => '一等奖',
            '2' => '二等奖',
            '3' => '三等奖',
            '4' => '四等奖',
            '5' => '五等奖',
            '6' => '六等奖',
            '7' => '七等奖',
            '8' => '八等奖',
            '9' => '九等奖',
            '10' => '十等奖',
        ];
        $result['level_name'] = $level_name[$prize_res['id']];
        $result['datetime'] = date('Y-m-d H:i:s');
        //添加抽奖次数
        ActiveTimes::addTimes($user_id, $day_date, 'active', $this->config->id);
        return $this->returnOkApi('成功', $result);

    }

    //更新用户信息
    public function userInfo($merchant, $token, $rel = '', Request $request)
    {
        $user_name = $request->input('user_name');
        $user_phone = $request->input('user_phone');
        $user_id=$request->input('user_id');
        if (!$user_name) {
            return $this->returnErrorApi('姓名不能为空');
        }
        if (!$user_phone) {
            return $this->returnErrorApi('手机号码不能为空');
        }
        //个人信息更新
        $user=User::find($user_id);
        if(empty($user))
        {
            return $this->returnErrorApi('会员不存在');
        }
        $user->username=$user_name;
        $user->phone=$user_phone;
        $r=$user->save();
        if($r)
        {
            //更新这个会员的中奖的用户个人信息
            ActivePrize::where(['user_id'=>$user_id])->update(['name'=>$user_name,'phone'=>$user_phone]);
            return $this->returnOkApi('提交成功');
        }else
        {
            return $this->returnErrorApi('提交失败');
        }
    }
}
