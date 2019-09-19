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
 * 安装数据表
 * Class Install
 * @package App\Plugin\Vote\Migrations
 */
class Install
{
    public function up()
    {
        if (!Schema::hasTable('vote_configs')) {
            Schema::create('vote_configs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('wx_merchant_id')->comment('微信商户id')->index();;
                $table->string('token')->nullable()->comment('token访问地址');
                $table->string('name')->comment('主题');
                $table->dateTime('start_at')->comment('投票开始时间');//开始时间
                $table->dateTime('end_at')->comment('投票结束时间');//结束时间
                $table->tinyInteger('is_checked')->default(1);//审核
                $table->tinyInteger('is_show_result')->default(1)->comment('是否直接显示结果');//结果
                $table->tinyInteger('is_only_vote')->default(1)->comment('是否只能投票一次');//只能投一次
                $table->text('content')->nullable()->comment('描述说明');
                $table->tinyInteger('is_prize')->comment('是否需要抽奖')->default(0);
                $table->string('thumb')->nullable();//图片
                $table->text('thumbs')->nullable();//图片相册
                $table->string('wx_share_title')->nullable();
                $table->string('wx_share_desc')->nullable();
                $table->string('wx_share_ico')->nullable();
                $table->text('tongji_script')->nullable()->comment('统计脚本');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('votes')) {
            Schema::create('votes', function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('openid')->nullable()->comment('opendid');
                $table->string('ip')->nullable();//openid
                $table->integer('vote_theme_id')->comment('主题id');//主题ID
                $table->integer('vote_item_id')->comment('选项ID');//选项ID
                $table->string('vote_config_id')->comment('来源id');//配置id
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('vote_items')) {
            Schema::create('vote_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('sort')->default(0);//
                $table->integer('vote_theme_id')->comment('主题id');//主题ID
                $table->string('name')->comment('主题名称');
                $table->string('thumb')->nullable()->comment('图片');
                $table->integer('total')->default(0)->comment('投票总量');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('vote_themes')) {
            Schema::create('vote_themes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('vote_config_id')->comment('投票设置id');//
                $table->integer('sort')->default(0);//
                $table->string('name')->comment('名称');
                $table->string('thumb')->nullable()->comment('图片');
                $table->tinyInteger('type_change')->default(0);//单选，多选
                $table->tinyInteger('is_must')->default(0);//是否必选
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('wx_merchants')) {
            Schema::create('wx_merchants', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('sort')->default(0);//排序
                $table->string('app_id')->nullable();//微信公众号appid
                $table->string('app_secret')->nullable();//微信公众号密钥
                $table->string('app_msgkey')->nullable();//微信消息加密
                $table->string('wxg_id')->nullable();//原始id
                $table->string('token');//接口token
                $table->string('token_url')->nullable();//接口地址
                $table->string('name')->nullable();//微信名字
                $table->string('province')->nullable();//省份
                $table->string('city')->nullable();//城市
                $table->tinyInteger('wx_authentication')->nullable();//微信认证，
                $table->string('sms_appid')->nullable();//SMS id
                $table->string('sms_appkey')->nullable();//sms key
                $table->string('sms_sign')->nullable();//sms 签名
                $table->string('sms_port')->nullable();//sms 端口
                $table->string('wx_name')->nullable();//微信号
                $table->string('wx_type')->nullable();//服务号/订阅号
                $table->string('wx_wxemail')->nullable();//微信账号邮箱
                $table->string('wx_wxpwd')->nullable();//微信密码
                $table->string('wx_phone')->nullable();//联系人电话
                $table->string('wx_tel')->nullable();//联系人电话
                $table->string('wx_email')->nullable();//联系人邮箱
                $table->string('wx_address')->nullable();//联系人地址
                $table->string('wx_pay_account')->nullable();//微信支付商户号
                $table->string('wx_pay_login_account')->nullable();//微信支付商户号
                $table->string('wx_pay_pwd_account')->nullable();//微信支付密码
                $table->string('wx_pay_key')->nullable();//微信支付密码
                $table->string('wx_apiclient_cert')->nullable();//微信证书apiclient_cert
                $table->string('wx_apiclient_key')->nullable();//微信证书apiclient_key
                $table->string('thumb')->nullable()->comment('微信二维码');//微信二维码
                $table->tinyInteger('is_checked')->nullable()->default(1);//是否审核通过
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('actives')) {
            Schema::create('actives', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('rel_type')->nullable()->comment('关联类型');
                $table->integer('rel_id')->default(0)->comment('关联id');
                $table->integer('wx_merchant_id')->comment('微信商户id')->index();;
                $table->string('token')->comment('token访问码');//游戏生成码
                $table->string('route_name')->nullable()->comment('绑定路由');
                $table->string('type')->nullable()->comment('插件形式');
                $table->string('name')->comment('活动主题');
                $table->tinyInteger('wx_open')->default(1);//必须微信打开
                $table->dateTime('start_at');//开始时间
                $table->dateTime('end_at');//结束时间
                $table->integer('prize_ratio')->default(100)->comment('中奖概率,10表示千人计算，类推');
                $table->tinyInteger('is_checked')->default(1);//开启/禁止
                $table->tinyInteger('prize_level')->nullable();//抽奖等级
                $table->text('template')->nullable()->comment('插件数据');//游戏模板
                $table->string('wx_share_tips')->nullable();;//微信分享提示
                $table->string('wx_share_ico')->nullable();;//微信分享图标
                $table->string('wx_share_title')->nullable();;//微信分享标题
                $table->string('wx_share_desc')->nullable();;//微信分享描述
                $table->string('fail_msg')->nullable();;//未中奖提示
                $table->string('over_msg')->nullable();;//机会抽完提示
                $table->string('follow_msg')->nullable();;//引导关注微信公众号号提示.
                $table->string('follow_type')->nullable();;//关注微信公众号号类型.
                $table->string('follow_source')->nullable();;//关注微信公众号来源.
                $table->tinyInteger('day_number_type')->default(1)->comment('抽奖类型,1是每次，2是一次');//
                $table->integer('day_number')->nullable();//每天抽奖次数
                $table->integer('total_number')->nullable();//游戏一共可以抽奖多少次
                $table->tinyInteger('prize_type')->default(1)->comment('中奖类型：只能中一次,2，多次，3，大奖为主');
                $table->string('end_msg')->comment('活动结束语')->nullable();;//微信分享提示
                $table->text('prize_msg')->nullable();;//奖品说明
                $table->text('intro_msg')->nullable();;//活动说明
                $table->string('seo_title', 255)->nullable();//
                $table->string('seo_keyword', 255)->nullable();//
                $table->string('seo_description', 255)->nullable();//
                $table->text('tongji_script')->nullable()->comment('统计脚本');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('active_prizes')) {
            Schema::create('active_prizes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('wx_merchant_id')->comment('微信商户id')->index();
                $table->integer('user_id')->index()->comment('用户ID');//用户ID
                $table->string('name')->nullable();//名字
                $table->string('phone')->nullable();//手机
                $table->string('thumb', 255)->nullable();//头像
                $table->string('openid')->nullable();//openid
                $table->string('active_name', 255)->comment('活动名称')->nullable();
                $table->integer('active_id')->nullable();//游戏ID
                $table->string('prize', 255)->nullable();//奖品名字
                $table->string('level', '120')->nullable();//奖品等级
                $table->tinyInteger('is_checked')->default(0);//奖品是否兑现0NO ,1 YES
                $table->string('prize_date', 255)->nullable();//兑现时间
                $table->string('prize_byer', 255)->nullable();//兑现人
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('active_times')) {
            Schema::create('active_times', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('user_id')->comment('会员ID');
                $table->string('model_type')->comment('类型');
                $table->integer('model_id')->comment('模型id');
                $table->tinyInteger('times')->default(0)->comment('次数');
                $table->date('play_date')->nullable()->comment('日期');
                $table->index('user_id');
                $table->timestamps();
                $table->index(['model_type', 'model_id']);
            });
        }
        if (!Schema::hasTable('prizes')) {
            Schema::create('prizes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('active_id')->comment('活动id');
                $table->string('name')->comment('奖品名称');
                $table->string('number')->comment('奖品数量');
                $table->decimal('ratio', 5, 2)->comment('奖品概率');
                $table->string('level')->comment('奖品等级');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('vote_users')) {
            Schema::create('vote_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('wx_merchant_id')->nullable();;
                $table->string('openid')->nullable();//
                $table->string('model_type')->comment('来源类型')->index();
                $table->integer('model_id')->comment('所属来源id')->index();//
                $table->string('nickname', '255')->nullable()->comment('用户昵称');//用户昵称
                $table->string('header_pic', 255)->nullable();//线上头像
                $table->string('phone', '120')->nullable();//手机
                $table->string('username', '120')->comment('姓名')->nullable();
                $table->string('company', '120')->comment('公司')->nullable();
                $table->string('tel', '120')->nullable();//电话
                $table->string('address', '255')->nullable();//地址
                $table->tinyInteger('is_checked')->default(1);//审核通过，未通过，等待审核
                $table->string('sex', '120')->nullable();//性别
                $table->string('birthday', '120')->nullable();//生日
                $table->string('age', '120')->nullable();//年龄
                $table->string('province', 120)->nullable();//省份
                $table->string('city', 120)->nullable();//城市
                $table->string('country', 120)->nullable();//国家
                $table->rememberToken();
                $table->timestamps();
            });
        }

    }
}