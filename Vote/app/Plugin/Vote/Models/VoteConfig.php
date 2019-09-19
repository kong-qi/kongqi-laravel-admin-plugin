<?php

namespace App\Plugin\Vote\Models;

use App\Models\BaseModel;

class VoteConfig extends BaseModel
{
    /**
     * 微信商户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(){
        return $this->belongsTo('App\Plugin\Vote\Models\WxMerchant','wx_merchant_id','id');
    }
}
