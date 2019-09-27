<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\AdminCurlController;
use App\Plugin\Vote\Models\Active;
use App\Plugin\Vote\Models\Prize;

use App\Plugin\Vote\Models\Vote;
use App\Plugin\Vote\Models\VoteConfig;
use App\Plugin\Vote\Models\WxMerchant;
use Illuminate\Http\Request;


class ActiveController extends AdminCurlController
{
    public $pageName = '活动';

    /**
     *  设置模型
     * @return WxMerchant|mixed
     */
    public function setModel()
    {
        return $this->model = new Active();
    }

    public function addPostData($model)
    {
        $add_rel_type = $this->rq->input('add_rel_type');
        if ($add_rel_type) {
            //切割
            $info = explode('_', $add_rel_type);
            if (!empty($info)) {
                $model->rel_type = $info[0];
                $model->rel_id = $info[1];
                //修改token，保持关联一致
                if ($model->rel_type == 'vote') {
                    $model->token = (VoteConfig::find($model->rel_id))->token;
                }

            }
        }
        return $model;
    }

    public function createEditData($show = '')
    {
        $ratio = [
            [
                'id' => 10,
                'name' => '按千人概率计算'
            ],
            [
                'id' => 100,
                'name' => '按万人概率计算'
            ],
            [
                'id' => 1000,
                'name' => '按10万人概率计算'
            ],
            [
                'id' => 10000,
                'name' => '按100万概率计算'
            ]

        ];
        $type = [
            [
                'id' => 'dazhuanpan',
                'name' => '大转盘'
            ]
        ];
        $prize_type = [
            [
                'id' => 1,
                'name' => '每天抽奖'
            ],
            [
                'id' => 2,
                'name' => '一次抽奖'
            ]
        ];
        $prize_level = [
            [
                'id' => 3,
                'name' => '3个奖品'
            ],
            [
                'id' => 4,
                'name' => '4个奖品'
            ]
            ,
            [
                'id' => 5,
                'name' => '5个奖品'
            ]
            ,
            [
                'id' => 6,
                'name' => '6个奖品'
            ]
            ,
            [
                'id' => 7,
                'name' => '7个奖品'
            ]
            ,
            [
                'id' => 8,
                'name' => '8个奖品'
            ]
            ,
            [
                'id' => 9,
                'name' => '9个奖品'
            ]
        ];
        $prize_win_type = [
            [
                'id' => 1,
                'name' => '只中一次'
            ],
            [
                'id' => 2,
                'name' => '可多次中奖'
            ],
        ];
        $rel_type = [
            [
                'id' => 'vote',
                'name' => '投票插件'
            ]
        ];
        $rel_id = [];
        $vote = VoteConfig::where('is_checked', 1)->get()->toArray();

        if (!empty($vote)) {
            foreach ($vote as $k => $v) {
                $rel_id[] =
                    [
                        'id' => 'vote_' . $v['id'],
                        'name' => '(投票插件)—' . $v['name']
                    ];
            }
        }

        return [
            'rel_id' => $rel_id,

            'wx_merchant' => WxMerchant::getAll(),
            'prize_level' => $prize_level,
            'ratio' => $ratio,
            'type' => $type,
            'prize_type' => $prize_type,
            'prize_win_type' => $prize_win_type
        ];
    }

    public function afterSave($model, $id = '')
    {
        $prizes = $this->rq->input('prizes');
        $arr = [];
        if ($prizes) {
            foreach ($prizes as $k => $v) {
                $v['active_id'] = $model->id;
                $v['level'] = $k;
                $arr[] = $v;
            }
        }
        if (!empty($arr)) {
            Prize::where('active_id', $model->id)->delete();
            Prize::insert($arr);
        }

    }

    public function checkRuleField()
    {
        return [

            'start_at' => '开始时间',
            'end_at' => '结束时间',

        ];
    }

    /**
     * JSON 列表输出项目设置
     * @param $item
     * @return mixed
     */
    public function apiJsonItemExtend($item)
    {

        $btns= [
            [
                'url' => plugin_url('Vote\Admin\ActivePrize', 'index', ['active_id' => $item->id]),
                'name' => '中奖数据',
                'class_name' => 'layui-btn-green'
            ],


        ];
        //判断是否关联，如果关联，则调用关联
        if ($item->rel_type) {
            $user_show=plugin_url('Vote\Admin\User', 'index', ['wx_merchant_id'=>$item->wx_merchant_id,'model_type' => 'vote', 'model_id' =>  $item->rel_id]);
            $show_url = route( 'plugin.vote.active.index', [
                    'merchant' => $item->wx_merchant_id, 'token' => $item->token, 'rel' => $item->rel_type . '_' . $item->rel_id
                ]
            );

        } else {
            $user_show=plugin_url('Vote\Admin\User', 'index', ['wx_merchant_id'=>$item->wx_merchant_id,'model_type' => 'active', 'model_id' =>  $item->id]);
            $show_url = route('plugin.vote.active.index', [
                    'merchant' => $item->wx_merchant_id, 'token' => $item->token
                ]
            );
        }
        $btns[]=[
            'url' => $user_show,
            'name' => '参与用户',
            'class_name' => 'layui-btn-info'
        ];

        $btns[] = [
            'url' => plugin_url('Vote\Admin\ViewShow', 'index', ['token' => base64_encode($show_url)]),
            'name' => '查看',
            'class_name' => 'layui-btn-primary'
        ];
        $item['btn_open']=$btns;
        $item['wx_merchant_name'] = $item->merchant['name'] ?? '';
        return $item;
    }

    /**
     * 表单验证规则
     * @param string $id
     * @return array
     */
    public function checkRule($id = '')
    {

        return [
            'name' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',

        ];

    }
    public function setModelAddRelaction($model)
    {
        return $model->with('merchant');//关联商户
    }

}
