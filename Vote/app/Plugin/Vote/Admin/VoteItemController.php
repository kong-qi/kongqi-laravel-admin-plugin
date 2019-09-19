<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\Vote\Models\VoteItem;
use Illuminate\Http\Request;
use App\Plugin\AdminCurlController;

class VoteItemController extends AdminCurlController
{
    public function indexData()
    {
        $item=[];
        $item['all_create_url'] = action($this->route['controller_name'] . '@allCreate',\request()->all());
        $item['all_post_url'] = action($this->route['controller_name'] . '@allCreatePost');
        return $item;
    }
    /**
     *  设置模型
     * @return WxMerchant|mixed
     */
    public function setModel()
    {
        return $this->model = new VoteItem();
    }



    public function checkRuleField()
    {
        return [

            'name' => '名称'


        ];
    }

    /**
     * 表单验证规则
     * @param string $id
     * @return array
     */
    public function checkRule($id = '')
    {

        return [
            'name' => 'required'


        ];

    }
    /**
     * 批量插入数据
     */
    public function allCreateSetData(Request $request){
        $name_arr=explode("\n",$request->name);
        $arr=[];
        if(empty($name_arr))
        {
            return [];
        }
        foreach ($name_arr as $k=>$v)
        {
            $arr[]=[
                'vote_theme_id'=>$request->input('vote_theme_id'),
                'name'=>$v,
                'thumb'=>$request->input('thumb')

            ];
        }
        return $arr;
    }
}
