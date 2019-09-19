<?php

Route::namespace('Admin')->group(function ($route) {
    Route::get('show/mobile/{token}', 'ViewShowController@index')->name('show.mobile');
    //增删改查之类，这里引入
    $resource = [
        'VoteConfigController',
        'VoteItemController',
        'VoteThemeController',
        'ActiveController',
        'WxMerchantController'
    ];
    //需要批量操作
    $more_add_controller = [
        'AdminPermissionController',
        'VoteThemeController',
        'VoteItemController',
    ];
    //只需要首页
    $only_index_controller = [
        'AdminLogController',
        'ActivePrizeController',
        'UserController'

    ];
    //只需要添加和首页
    $only_add_controller = [

    ];
    //需要表格导入
    $import_add_controller = [

    ];

    foreach ($resource as $c) {
        //自动获取
        $controller = str_replace('Controller', '', $c);
        $controller_path = strtolower($controller);

        $route->group(['prefix' => $controller_path . '/'], function ($route) use ($c, $controller_path) {

            $route->get('/', $c . '@index')->name($controller_path . ".index");
            $route->get('create', $c . '@create')->name($controller_path . ".create");
            $route->get('show/{id}', $c . '@show')->name($controller_path . ".show");
            $route->post('store', $c . '@store')->name($controller_path . ".store");
            $route->get('edit/{id}', $c . '@edit')->name($controller_path . ".edit");
            $route->put('update/{id}', $c . '@update')->name($controller_path . ".update");
            $route->put('delete/', $c . '@destroy')->name($controller_path . ".destroy");
            $route->post('edit_list/', $c . '@editTable')->name($controller_path . ".edit_list");
        });

        $route->any($controller_path . '/list', ['uses' => $c . '@getList'])->name($controller_path . ".list");

        //增加批量操作
        if (in_array($c, $more_add_controller)) {
            $route->get($controller_path . '/all/create', ['uses' => $c . '@allCreate'])->name($controller_path . '.all_create');
            $route->post($controller_path . '/all/create/post', ['uses' => $c . '@allCreatePost'])->name($controller_path . '.all_create_post');
        }
        //导入操作
        if (in_array($c, $more_add_controller)) {
            $route->post($controller_path . '/import/post', ['uses' => $c . '@importPost'])->name($controller_path . '.import_post');
            $route->get($controller_path . '/import/tpl', ['uses' => $c . '@importTpl'])->name($controller_path . '.import_tpl');
        }
    }
    //只需要首页控制器
    foreach ($only_index_controller as $c) {
        $controller = str_replace('Controller', '', $c);
        $controller_path = strtolower($controller);
        $route->group(['prefix' => $controller_path . '/'], function ($route) use ($c, $controller_path) {
            $route->get('/', $c . '@index')->name($controller_path . ".index");
            $route->any($c . '/list', ['uses' => $c . '@getList'])->name($controller_path . ".list");
        });

    }
    //著需要添加和首页
    foreach ($only_add_controller as $c) {
        $controller = str_replace('Controller', '', $c);
        $controller_path = strtolower($controller);
        $route->group(['prefix' => $controller_path . '/'], function ($route) use ($c, $controller_path) {
            $route->get('/', $c . '@index')->name($controller_path . ".index");
            $route->post('store', $c . '@store')->name($controller_path . ".store");
            $route->any($c . '/list', ['uses' => $c . '@getList'])->name($controller_path . ".list");
        });

    }
});
?>