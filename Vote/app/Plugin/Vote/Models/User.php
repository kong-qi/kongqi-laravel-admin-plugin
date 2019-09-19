<?php
// +----------------------------------------------------------------------
// | KongQiAdminBase [ Laravel快速后台开发 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2012~2019 http://www.kongqikeji.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: kongqi <531833998@qq.com>`
// +----------------------------------------------------------------------
namespace App\Plugin\Vote\Models;

use App\Models\AuthModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends AuthModel
{
    public $table='vote_users';

    protected $guarded = [];
    /**
     * 创建用户
     * @param $wx_merchant_id
     * @param $model_type
     * @param $model_id
     * @param $nickname
     * @param $openid
     * @param string $thumb
     * @return mixed
     */
    public static function createOrGetModel($openid,$wx_merchant_id,$model_type,$model_id,$nickname='',$thumb=''){

        $user=self::where('openid',$openid)->first();
        if($user)
        {
            return $user;
        }
        return self::create([
            'wx_merchant_id'=>$wx_merchant_id,
            'openid'=>$openid,
            'model_type'=>$model_type,
            'model_id'=>$model_id,
            'nickname'=>$nickname,
            'header_pic'=>$thumb,
            'username'=>''
        ]);
    }

    /**
     * 根据模型获取用户信息
     * @param $merchant_id
     * @param $model_type
     * @param string $model_id
     * @return mixed
     */
    public static function getUser($merchant_id,$model_type,$model_id=''){
        $where=[
            'wx_merchant_id'=>$merchant_id,
            'model_type'=>$model_type
        ];
        if($model_id)
        {
            $where['model_id']=$model_id;
        }
        return self::where($where)->first();
    }
}
