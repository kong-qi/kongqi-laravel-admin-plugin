<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\Vote\Models\User;
use App\Plugin\AdminCurlController;
use Illuminate\Http\Request;


class UserController extends AdminCurlController
{
    public $pageName = '用户数据';

    /**
     *  设置模型
     * @return WxMerchant|mixed
     */
    public function setModel()
    {
        return $this->model = new User();
    }
    /**
     * JSON 列表输出项目设置
     * @param $item
     * @return mixed
     */
    public function apiJsonItem($item)
    {
        $model_type=\request()->input('model_type');
        $model_id=\request()->input('model_id');
        if($model_type=='vote')
        {
            //查看用户投了什么
            $item['btn_open']=[
                [
                    'url'=>plugin_url('Vote\Admin\VoteConfig','show',['id'=>$item->model_id,'user_id'=>$item->openid]),
                    'name'=>'投票详情',
                    'class_name'=>'layui-btn-primary',
                    'w'=>'500px',
                    'h'=>'600px'
                ]
            ];
        }
        return $item;
    }
}
