<?php

namespace App\Plugin\Vote\Front;

use App\Plugin\Vote\Models\User;
use App\Plugin\Vote\Models\Vote;
use App\Plugin\Vote\Models\VoteConfig;
use App\Plugin\Vote\Models\VoteItem;
use App\Plugin\Vote\Models\VoteTheme;
use App\Plugin\Vote\Models\WxMerchant;
use App\Services\WeiXinServices;
use Illuminate\Http\Request;


class VoteController extends BaseController
{
    protected $token;
    protected $voteConfig;
    protected $merchant;//商户
    protected $isResponse = 0;
    public $sessionName = '';

    public function __construct(Request $request)
    {

        parent::__construct();


        $this->token = $request->token;
        $merchant_id = $request->merchant;
        $this->merchant = WxMerchant::find($merchant_id);
        $this->voteConfig = VoteConfig::where('token', $this->token)->first();
        //必须写在中间件认证之后的下面，才能有效,
        $this->middleware(function ($request, $next) {
            if (empty($this->voteConfig) || empty($this->merchant)) {
                $this->isResponse = 1;
                return $this->error('不存在', '请确认链接地址是否正确');
            }
            view()->share(['title'=>$this->voteConfig->name]);
            $this->sessionName = 'vote_session_' . $this->voteConfig->id;
            return $next($request);
        });


    }


    //取得项目的URL
    public function getUrl()
    {
        return plugin_route('vote.vote.index', ['merchant' => $this->merchant, 'token' => $this->token]);
    }

    /**
     * 取得个人投票的数量
     * @param $vote_id
     * @param $uid
     * @param string $type
     * @return bool
     */
    public function isVote($uid, $type = 'openid')
    {
        $total = Vote::where('vote_config_id', $this->voteConfig->id)->where($type, $uid)->count();
        if ($total > 0) {
            return true;
        }
        return false;
    }


    public function index($merchant, $token, Request $request)
    {

        $self_url = $this->getUrl();
        $user = '';
        $wx_user = '';
        $openid = '';
        //判断是否存在

        if (!env('WXDEMO')) {
            $session_info = session($this->sessionName);

            if ($session_info) {
                $session_info = json_decode(unserialize($session_info), 1);

                $openid = $session_info['openid'];
            } else {
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
                $session_data2 = serialize(json_encode($session_data));

                $request->session()->put($this->sessionName, $session_data2);

                //会员入库
                $user = User::createOrGetModel($session_data['openid'], $this->merchant->id, 'vote', $this->voteConfig->id, $session_data['nickname'], $session_data['avatar']);

            }
        } else {
            $user = '';
            $openid = 'xxx1232323232243242344'.time();
        }

        //判断用户是否存在，如果存在则不添加
        if (!$user) {
            $user = User::createOrGetModel($openid, $this->merchant->id, 'vote', $this->voteConfig->id);
        }

        //存入sesssion
        session(['active_user' => $user->toArray()]);

        //判断是否已经实际到期
        $start_time = strtotime($this->voteConfig->start_at);//游戏开始时间
        $end_time = strtotime($this->voteConfig->end_at);//结束时间
        $now_time = time();//现在时间
        if ($start_time > $now_time) {

            return $this->error('活动还没开始', '开始时间是' . $this->voteConfig->start_at);

        }

        if ($end_time < $now_time) {
            //结束是否显示结果
            return $this->error('已经结束', '结束时间是:' . $this->voteConfig->end_at, ['back' => 0]);

        }


        //判断是否已经投票，如果是则给提示
        if ($this->isVote($openid)) {
            $btns=[];
            if($this->voteConfig->is_prize)
            {
                $url = plugin_route('vote.active.index', ['merchant' => $this->merchant->id, 'token' => $token, 'rel' => 'vote_' . $this->voteConfig->id]);
                $btns = [
                    [
                        'name' => '进入抽奖',
                        'url' => $url,
                        'classname'=>''
                    ]
                ];
            }





            return $this->success('你已经参与过了', '感谢您的参与', ['back' => 0,'btn'=>$btns]);

        }

        //取得投票主题
        $theme = VoteTheme::where('vote_config_id', $this->voteConfig->id)->orderBy('sort', 'desc')->orderBy('id', 'asc')->get()->toArray();
        //取得投票选项，以投票主题的ID作为KEY
        $item = VoteTheme::toTtem($theme);

        $data = [
            'vote_config' => $this->voteConfig,
            'merchant' => $this->merchant,
            'openid' => $openid,
            'theme' => $theme,
            'token' => $token,
            'item' => $item,
            'wxshare' => [
                'title' => $this->voteConfig->wx_share_title,
                'url' => $self_url,
                'desc' => $this->voteConfig->wx_share_desc,
                'ico' => picurl($this->voteConfig->wx_share_ico),
                'type' => '',
                'dataurl' => ''
            ],
            'title' => $this->voteConfig->name,
            'content' => $this->voteConfig->content,
            'user' => $user,

        ];
        return $this->display($data);
    }

    public function store($merchant, $token, Request $request)
    {
        //
        $items = $request->input('items');
        $open_id = $request->input('openid');
        if (empty($items)) {
            return $this->returnErrorApi('缺少参数');
        }
        //查询vote_item表
        $item = VoteItem::whereIn('id', $items)->get();
        if (empty($item)) {
            return $this->returnErrorApi('缺少参数');
        }
        $data = [];
        foreach ($item as $k => $v) {
            $data[] = [
                'openid' => $open_id,
                'vote_theme_id' => $v->vote_theme_id,
                'vote_item_id' => $v->id,
                'vote_config_id' => $this->voteConfig->id,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        $r = Vote::insert($data);
        //更新会员信息
        $user = User::find($request->input('user_id'));
        $user->phone = $request->input('phone');
        $user->username = $request->input('username');
        $user->company = $request->input('company');
        $user->save();
        if ($r) {
            return $this->returnOkApi('参与提交成功');
        }
        return $this->returnErrorApi('参与提交失败');
    }
}
