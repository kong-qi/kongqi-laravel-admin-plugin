<?php
// +----------------------------------------------------------------------
// | KongQiAdminBase [ Laravel快速后台开发 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2012~2019 http://www.kongqikeji.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: kongqi <531833998@qq.com>`
// +----------------------------------------------------------------------

namespace  App\Plugin\Vote\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * 填充/初始化数据
 * Class Seed
 * @package App\Plugin\Vote\Migrations
 */

class Seed
{
    public  function up(){
        $wx_merchants = [
            ['id' => '1', 'sort' => '0', 'app_id' => 'wx7c1b2b80da7cc2d4', 'app_secret' => '4de52fd29d9f49aacadbe88077433638', 'app_msgkey' => '', 'wxg_id' => NULL, 'token' => '', 'token_url' => '', 'name' => '空气工作室', 'province' => NULL, 'city' => NULL, 'wx_authentication' => NULL, 'sms_appid' => NULL, 'sms_appkey' => NULL, 'sms_sign' => NULL, 'sms_port' => NULL, 'wx_name' => NULL, 'wx_type' => NULL, 'wx_wxemail' => NULL, 'wx_wxpwd' => NULL, 'wx_phone' => NULL, 'wx_tel' => NULL, 'wx_email' => NULL, 'wx_address' => NULL, 'wx_pay_account' => NULL, 'wx_pay_login_account' => NULL, 'wx_pay_pwd_account' => NULL, 'wx_pay_key' => NULL, 'wx_apiclient_cert' => NULL, 'wx_apiclient_key' => NULL, 'thumb' => '', 'is_checked' => '1', 'created_at' => '2019-09-13 04:15:27', 'updated_at' => '2019-09-13 04:15:27']
        ];
        DB::table('wx_merchants')->truncate();
        DB::table('wx_merchants')->insert($wx_merchants);

        $vote_themes = [
            ['id' => '1', 'vote_config_id' => '1', 'sort' => '0', 'name' => '否是护航老客户？', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => '2019-09-13 04:49:14'],
            ['id' => '2', 'vote_config_id' => '1', 'sort' => '0', 'name' => '您的企业所在的行业是？', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '3', 'vote_config_id' => '1', 'sort' => '0', 'name' => '您是否参与过网络推广？', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '4', 'vote_config_id' => '1', 'sort' => '0', 'name' => '您目前参与过的网络推广相关的工作有', 'thumb' => NULL, 'type_change' => '2', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '5', 'vote_config_id' => '1', 'sort' => '0', 'name' => '您认为现阶段，网络推广最主要的任务是 ', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '6', 'vote_config_id' => '1', 'sort' => '0', 'name' => '针对网络推广，您现在最不满意（或有待提升）的是', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '7', 'vote_config_id' => '1', 'sort' => '0', 'name' => '如果有市场预算，您会重点选择哪种花钱的推广方式', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '8', 'vote_config_id' => '1', 'sort' => '0', 'name' => '为了企业的销售或品牌收益，您觉得在互联网上应该开展那些推广手段（最有效）', 'thumb' => NULL, 'type_change' => '2', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '9', 'vote_config_id' => '1', 'sort' => '0', 'name' => '您最想通过网络达成你的企业目标是？', 'thumb' => NULL, 'type_change' => '1', 'is_must' => '1', 'created_at' => NULL, 'updated_at' => NULL]
        ];
        DB::table('vote_themes')->truncate();
        DB::table('vote_themes')->insert($vote_themes);
        $actives = array(
            array('id' => '1','rel_type' => 'vote','rel_id' => '1','wx_merchant_id' => '1','token' => 'LuNFpV4K9XjTG51k8ESogfPvnhrr190WAVl29Icz','route_name' => NULL,'type' => 'dazhuanpan','name' => '参与调查抽奖','wx_open' => '1','start_at' => '2019-09-13 00:00:00','end_at' => '2019-10-10 00:00:00','prize_ratio' => '100','is_checked' => '1','prize_level' => '9','template' => NULL,'wx_share_tips' => NULL,'wx_share_ico' => '','wx_share_title' => '非常抱歉，抽奖机会用完','wx_share_desc' => '非常抱歉，抽奖机会用完','fail_msg' => '还没中奖哦！','over_msg' => '非常抱歉，抽奖机会用完','follow_msg' => '关注我们，领取奖品！','follow_type' => NULL,'follow_source' => NULL,'day_number_type' => '2','day_number' => '1','total_number' => NULL,'prize_type' => '1','end_msg' => '活动结束','prize_msg' => '<p>55444</p>','intro_msg' => '<p>555</p>','seo_title' => NULL,'seo_keyword' => NULL,'seo_description' => NULL,'created_at' => '2019-09-13 04:54:50','updated_at' => '2019-09-15 02:49:20')
        );

        DB::table('actives')->truncate();
        DB::table('actives')->insert($actives);
        $vote_configs = [
            ['id' => '1', 'wx_merchant_id' => '1', 'token' => 'LuNFpV4K9XjTG51k8ESogfPvnhrr190WAVl29Icz', 'name' => '问卷调查', 'start_at' => '2019-09-13 00:00:00', 'end_at' => '2019-10-10 00:00:00', 'is_checked' => '1', 'is_show_result' => '1', 'is_only_vote' => '1', 'thumb' => NULL, 'thumbs' => NULL, 'wx_share_title' => '护航问卷调查', 'wx_share_desc' => '参与问卷调查，即可抽奖！', 'wx_share_ico' => '', 'created_at' => '2019-09-13 04:17:46', 'updated_at' => '2019-09-13 04:17:46']
        ];
        DB::table('vote_configs')->truncate();
        DB::table('vote_configs')->insert($vote_configs);

        $vote_items = [
            ['id' => '1', 'sort' => '0', 'vote_theme_id' => '1', 'name' => '是', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '2', 'sort' => '0', 'vote_theme_id' => '1', 'name' => '否', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '3', 'sort' => '0', 'vote_theme_id' => '2', 'name' => '生产型企业', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '4', 'sort' => '0', 'vote_theme_id' => '2', 'name' => '销售型企业', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '5', 'sort' => '0', 'vote_theme_id' => '2', 'name' => '互联网行业', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '6', 'sort' => '0', 'vote_theme_id' => '2', 'name' => '服务型企业', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '7', 'sort' => '0', 'vote_theme_id' => '2', 'name' => '其他', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '8', 'sort' => '0', 'vote_theme_id' => '3', 'name' => '是', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '9', 'sort' => '0', 'vote_theme_id' => '3', 'name' => '否', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '10', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网络调研', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '11', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网站建设', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '12', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网站优化', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '13', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网络广告投放', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '14', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网络推广', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '15', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网络销售', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '16', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网络品牌宣传推广', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '17', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '网络营销项目管理', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '18', 'sort' => '0', 'vote_theme_id' => '4', 'name' => '其他', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '19', 'sort' => '0', 'vote_theme_id' => '5', 'name' => '网站的建设', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '20', 'sort' => '0', 'vote_theme_id' => '5', 'name' => '网站运营推广', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '21', 'sort' => '0', 'vote_theme_id' => '5', 'name' => '网络销售接单', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '22', 'sort' => '0', 'vote_theme_id' => '5', 'name' => '网络品牌传播', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '23', 'sort' => '0', 'vote_theme_id' => '5', 'name' => '网络公关危机处理', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '24', 'sort' => '0', 'vote_theme_id' => '5', 'name' => '其他', 'thumb' => '', 'total' => '0', 'created_at' => '2019-09-13 04:37:26', 'updated_at' => '2019-09-13 04:37:26'],
            ['id' => '25', 'sort' => '0', 'vote_theme_id' => '6', 'name' => '推广方式', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '26', 'sort' => '0', 'vote_theme_id' => '6', 'name' => '销售量', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '27', 'sort' => '0', 'vote_theme_id' => '6', 'name' => '品牌传播度', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '28', 'sort' => '0', 'vote_theme_id' => '6', 'name' => '客户认知度', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '29', 'sort' => '0', 'vote_theme_id' => '7', 'name' => '搜索竞价广告', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '30', 'sort' => '0', 'vote_theme_id' => '7', 'name' => '网站联盟广告', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '31', 'sort' => '0', 'vote_theme_id' => '7', 'name' => '网络软文刊发', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '32', 'sort' => '0', 'vote_theme_id' => '7', 'name' => '定向网站投放', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '33', 'sort' => '0', 'vote_theme_id' => '7', 'name' => '网络整合推广', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '34', 'sort' => '0', 'vote_theme_id' => '7', 'name' => '网络公关传播炒作', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '35', 'sort' => '0', 'vote_theme_id' => '8', 'name' => '搜索引擎营销（SEM：搜索引擎排名优化seo + 竞价广告）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '36', 'sort' => '0', 'vote_theme_id' => '8', 'name' => '广告联盟营销（只按效果付费CPA/按销售量付费CPS）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '37', 'sort' => '0', 'vote_theme_id' => '8', 'name' => '整合营销（论坛营销、博客营销、软文营销、新闻营销……）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '38', 'sort' => '0', 'vote_theme_id' => '8', 'name' => '网络公关、传播、炒作（话题植入营销、事件营销、病毒式营销）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '39', 'sort' => '0', 'vote_theme_id' => '8', 'name' => '联属会员制营销（建立CPS联盟 + 会员销售制）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '40', 'sort' => '0', 'vote_theme_id' => '8', 'name' => 'EDM邮件营销（许可/列表/邮件数据库）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '41', 'sort' => '0', 'vote_theme_id' => '8', 'name' => 'DM目录营销 & 数据库营销（基于会员数据库）', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '42', 'sort' => '0', 'vote_theme_id' => '8', 'name' => '互联网直复营销 或 互联网CRM关系营销', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '43', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '推广网站', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '44', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '推广新产品', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '45', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '品牌宣传', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '46', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '促进销售量', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '47', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '降低宣传成本', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '48', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '发展经销商', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '49', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '企业形象展示', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '50', 'sort' => '0', 'vote_theme_id' => '9', 'name' => '其他', 'thumb' => NULL, 'total' => '0', 'created_at' => NULL, 'updated_at' => NULL]
        ];
        DB::table('vote_items')->truncate();
        DB::table('vote_items')->insert($vote_items);

        $prizes = [
            ['id' => '1', 'active_id' => '1', 'name' => '５折八网合一建站', 'number' => '5', 'ratio' => '0.20', 'level' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '2', 'active_id' => '1', 'name' => '记账代金券', 'number' => '5', 'ratio' => '0.20', 'level' => '2', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '3', 'active_id' => '1', 'name' => '商标设计６折', 'number' => '5', 'ratio' => '0.20', 'level' => '3', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '4', 'active_id' => '1', 'name' => '域名主机免费赠送', 'number' => '5', 'ratio' => '0.40', 'level' => '4', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '5', 'active_id' => '1', 'name' => '企业邮箱免费送', 'number' => '5', 'ratio' => '4.00', 'level' => '5', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '6', 'active_id' => '1', 'name' => '5元现金奖', 'number' => '5', 'ratio' => '5.00', 'level' => '6', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '7', 'active_id' => '1', 'name' => '2元现金奖', 'number' => '10', 'ratio' => '5.00', 'level' => '7', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '8', 'active_id' => '1', 'name' => '1元现金奖', 'number' => '10', 'ratio' => '5.00', 'level' => '8', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => '9', 'active_id' => '1', 'name' => '免费商家入', 'number' => '10000000', 'ratio' => '80.00', 'level' => '9', 'created_at' => NULL, 'updated_at' => NULL]
        ];
        DB::table('prizes')->truncate(); DB::table('prizes')->insert($prizes);
    }
}