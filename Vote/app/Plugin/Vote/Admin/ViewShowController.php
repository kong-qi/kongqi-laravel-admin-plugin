<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\AdminBaseController;
use Illuminate\Http\Request;


class ViewShowController extends AdminBaseController
{
    //
    public function index($token,Request $request){
        $data['url']=base64_decode($token);
        //$data=['url'=>'https://www.layui.com/doc/modules/form.html#onselect'];
        return $this->display($data);
    }
}
