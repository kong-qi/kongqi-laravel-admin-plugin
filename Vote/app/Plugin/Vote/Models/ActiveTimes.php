<?php

namespace App\Plugin\Vote\Models;

use App\Models\BaseModel;

class ActiveTimes extends BaseModel
{
    /**
     * 取得次数
     * @param string $date
     * @param $model_type
     * @param $model_id
     * @return bool|int
     */
    public static function getTime($user_id,$date = '', $model_type, $model_id)
    {
        $where = [
            'user_id'=>$user_id,
            'model_type' => $model_type,
            'model_id' => $model_id
        ];
        if ($date) {
            $where['play_date'] = date('Y-m-d');
        }
        $times = self::where($where)->first();

        if (empty($times)) {
            return 0;
        }
        return $times['times'] ?? 0;

    }

    /**
     * 添加次数
     * @param string $date
     * @param $model_type
     * @param $model_id
     * @return mixed
     */
    public static function addTimes($user_id,$date = '', $model_type, $model_id)
    {
        $where = [
            'model_type' => $model_type,
            'model_id' => $model_id,
            'user_id'=>$user_id
        ];
        if ($date) {
            $where['play_date'] = date('Y-m-d');
        }
        $times = self::where($where)->first();
        if (empty($times)) {
            $where['times'] = 1;
            //进行添加
            return self::create($where);
        } else {
            //进行更新
            $times->times = $times->times + 1;
            return $times->save();
        }
    }
}
