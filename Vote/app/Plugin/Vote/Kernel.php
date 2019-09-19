<?php
// +----------------------------------------------------------------------
// | KongQiAdminBase [ Laravel快速后台开发 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2012~2019 http://www.kongqikeji.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: kongqi <531833998@qq.com>`
// +----------------------------------------------------------------------
//组不允许再定义web,api，就算添加也无效
return [
    "middlewareGroups" => [
    ],
    "routeMiddleware" => [
        'text' => App\Plugin\Vote\Middleware\VoteTestMiddleware::class,
    ]
];