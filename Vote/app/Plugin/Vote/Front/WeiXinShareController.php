<?php

namespace App\Plugin\Vote\Front;

use App\Plugin\Vote\Models\WxMerchant;
use App\Services\WeiXinServices;
use App\TraitClass\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeiXinShareController extends Controller
{
    //
    use ApiTrait;
    public function api($merchant='',Request $request){
        $url=urldecode($request->input('url'));
        $is_debug=($request->input('debug',0));

        $merchant=$this->getMerchant($merchant);
        if(empty($merchant))
        {
            return $this->returnErrorApi('缺少商户信息');
        }
        WeiXinServices::config($merchant['app_id'],$merchant['app_secret']);
        $data= WeiXinServices::share(['updateAppMessageShareData', 'updateTimelineShareData','onMenuShareAppMessage','onMenuShareTimeline'],$url?? $request->fullUrl(),$is_debug);
        return $this->returnOkApi('ok',$data);
    }
    public function getMerchant($id){
        if($id)
        {
            return WxMerchant::find($id);
        }
        return WxMerchant::first();

    }
}
