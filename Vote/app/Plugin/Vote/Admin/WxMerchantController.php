<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\Vote\Models\WxMerchant;
use Illuminate\Http\Request;
use App\Plugin\AdminCurlController;

class WxMerchantController extends AdminCurlController
{
    /**
     *  设置模型
     * @return WxMerchant|mixed
     */
    public function setModel()
    {
        return $this->model = new WxMerchant();
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
            'app_id' => 'required',
            'app_secret' => 'required',

        ];

    }

}
