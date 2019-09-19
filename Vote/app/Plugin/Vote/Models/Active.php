<?php

namespace App\Plugin\Vote\Models;


use App\Models\BaseModel;

class Active extends BaseModel
{
    //
    public function prizeConfig(){
        return $this->hasMany('App\Plugin\Vote\Models\Prize','active_id','id');
    }
    /**
     * 微信商户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(){
        return $this->belongsTo('App\Plugin\Vote\Models\WxMerchant','wx_merchant_id','id');
    }
}
