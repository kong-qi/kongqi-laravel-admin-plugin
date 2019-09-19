<?php
// +----------------------------------------------------------------------
// | KongQiAdminBase [ Laravel快速后台开发 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2012~2019 http://www.kongqikeji.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: kongqi <531833998@qq.com>`
// +----------------------------------------------------------------------

namespace App\Plugin\Vote\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 移除数据表
 * Class Install
 * @package App\Plugin\Vote\Migrations
 */
class Remove
{
    public function up()
    {
        Schema::dropIfExists('vote_configs');
        Schema::dropIfExists('votes');
        Schema::dropIfExists('vote_items');
        Schema::dropIfExists('vote_themes');
        Schema::dropIfExists('wx_merchants');
        Schema::dropIfExists('actives');
        Schema::dropIfExists('active_prizes');
        Schema::dropIfExists('active_times');
        Schema::dropIfExists('prizes');
        Schema::dropIfExists('vote_users');

    }
}