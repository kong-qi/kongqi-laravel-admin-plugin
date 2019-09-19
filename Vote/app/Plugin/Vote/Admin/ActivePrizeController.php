<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\Vote\Models\ActivePrize;
use App\Plugin\Vote\Models\WxMerchant;
use Illuminate\Http\Request;
use App\Plugin\AdminCurlController;

class ActivePrizeController extends AdminCurlController
{
    public $pageName='中奖数据';
    /**
     *  设置模型
     * @return WxMerchant|mixed
     */
    public function setModel()
    {
        return $this->model = new ActivePrize();
    }



    /**
     * JSON 列表输出项目设置
     * @param $item
     * @return mixed
     */
    public function apiJsonItem($item)
    {
        return $item;
    }


}
