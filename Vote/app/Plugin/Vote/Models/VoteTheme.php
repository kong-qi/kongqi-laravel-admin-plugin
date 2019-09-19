<?php

namespace App\Plugin\Vote\Models;

use App\Models\BaseModel;

class VoteTheme extends BaseModel
{
    //
    public static function toTtem($data){

        $item=VoteItem::whereIn('vote_theme_id',self::toId($data))->orderBy('sort','desc')->orderBy('id','asc')->get()->toArray();

        if(empty($item))
        {
            return [];
        }
        $arr=[];
        foreach ($item as $key => $value) {
            if(!in_array($value['vote_theme_id'],$arr))
            {
                $arr[$value['vote_theme_id']][]=$value;
            }
        }
        return $arr;
    }
    public static function toId($data){
        if(empty($data))
        {
            return array();
        }
        $arr=array();
        foreach ($data as $key => $value) {
            $arr[]=$value['id'];
        }
        return $arr;
    }
}
