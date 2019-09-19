<?php

namespace App\Plugin\Vote\Models;

use App\Models\BaseModel;

class WxMerchant extends BaseModel
{
    //
    public static function getAll(){
        return self::where('is_checked',1)->get()->toArray();
    }
}
