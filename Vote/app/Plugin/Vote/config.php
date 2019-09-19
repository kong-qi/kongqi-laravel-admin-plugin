<?php
// +----------------------------------------------------------------------
// | KongQiAdminBase [ Laravel快速后台开发 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2012~2019 http://www.kongqikeji.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: kongqi <531833998@qq.com>`
// +----------------------------------------------------------------------

return [
    'is_install '=>0,//是否安装
    'name'=>'微信投票抽奖插件',//插件名字
    'ename'=>'Vote',//唯一标识符,根你的插件模块名字一致
    'intro'=>'微信简单投票，抽奖应用',
    'author' => '空气工作室',
    'author_desc'=>'7年工作开发经验，10年接触编程',//作者介绍

    'version' => '1.0.0',
    'domain' => 'www.kongqikeji.com',
    'qq' => '531833998',
    'weixin' => '13420454614',
    'mobile'=>'13420454614',
    'email' => '531833998@qq.com',
    //插件地址
    'domain_plugin' => '',//带http地址
    //演示地址
    'domain_plugin_test'=>'',//带http地址
    //演示多图
    'thumbs' => [
       // 'https://xxx.jpg', 'https://xxx2.jpg'
    ],
    //缩略图
    'thumb' => plugin_res('/vote/images/intro.jpg'),
    //后台菜单
    'admin_menu' => [
        'name' => '微信应用',
        'icon' => 'layui-icon layui-icon-user',//图标
        'router' => '',
        'limit' => 'admin.vote',
        'is_hide' => 0,
        'sub_menus' => [
            [
                'title' => '微信商户',
                'router' => 'admin.plugin.vote.wxmerchant.index',//路由地址
                'icon' => 'fa fa-circle-o',
                'is_hide' => 0
            ],
            [
                'title' => '投票插件',
                'router' => 'admin.plugin.vote.voteconfig.index',
                'icon' => 'fa fa-circle-o',
                'is_hide' => 0
            ],
            [
                'title' => '活动插件',
                'router' => 'admin.plugin.vote.active.index',
                'icon' => 'fa fa-circle-o',
                'is_hide' => 0
            ]
        ]
    ]
];