<?php

namespace App\Plugin\Vote\Admin;

use App\Plugin\Vote\Models\VoteConfig;
use App\Plugin\Vote\Models\VoteTheme;
use App\Plugin\Vote\Models\WxMerchant;
use Illuminate\Http\Request;
use App\Plugin\AdminCurlController;

class VoteThemeController extends AdminCurlController
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
        return $this->model = new VoteTheme();
    }

    public function apiJsonItemExtend($item){
        $item->is_must_name=$item->is_must?'是':'否';
        $item->type_change_name=$item->type_change==1?'单选':'多选';
        $item['btn_open']=[
            [
                'url'=>plugin_url('Vote\Admin\VoteItem','index',['vote_theme_id'=>$item->id,'vote_config_id'=>\request()->input('vote_config_id')]),
                'name'=>'设置选项',
                'class_name'=>'layui-btn-green',
                'title'=>$item->name
            ]
        ];
        return $item;
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
                'vote_config_id'=>$request->input('vote_config_id'),
                'name'=>$v,
                'is_must'=>$request->input('is_must'),
                'type_change'=>$request->input('type_change'),
            ];
        }
        return $arr;
    }
}
