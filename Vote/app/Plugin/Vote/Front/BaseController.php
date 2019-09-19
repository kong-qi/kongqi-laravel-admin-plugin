<?php

namespace App\Plugin\Vote\Front;


use App\Plugin\FrontBaseController;

class BaseController extends FrontBaseController
{
    public $module = 'Plugin\Vote';//模块名字,必须定义
    protected $isResponse = 0;
    public $controllerReplace='App\\Plugin\\Vote';//控制器替换路径，必须定义


    public function error($msg, $desc = '', $data = [])
    {

        $default_data = [
            'icon' => 'weui-icon-warn weui-icon_msg'
        ];
        $default_data = $data + $default_data;

        return $this->tips($msg, $desc, $default_data);
    }

    public function success($msg, $desc = '', $data = [])
    {
        $default_data = [
            'icon' => 'weui-icon-success weui-icon_msg'
        ];
        $default_data = $data + $default_data;
        return $this->tips($msg, $desc, $default_data);
    }

    public function tips($msg, $desc, $data = [])
    {
        $default_data = [
            'title' => $msg,
            'back' => 1,
            'icon' => 'weui-icon-success weui-icon_msg'
        ];
        if ($desc) {
            $default_data['desc'] = $desc;
        }
        $data = $data + $default_data;
        if (request()->ajax() || request()->wantsJson()) {
            {
                return $this->returnErrorApi($msg);
            }
        }
        if ($this->isResponse) {
            return response()->view('tips.tips', ['message' => $data]);
        }

        return view('tips.tips', ['message' => $data]);
    }

}
