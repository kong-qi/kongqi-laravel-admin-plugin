<?php

//投票
Route::prefix('vote')->namespace('Front')->group(function ($route) {
    $route->get('/{merchant}/{token}', 'VoteController@index')->name('vote.index');
    $route->post('/{merchant}/{token}/store', 'VoteController@store')->name('vote.index.post');

});
//活动
Route::prefix('active')->namespace('Front')->group(function ($route) {
    $route->post('/{merchant}/{token}/userinfo/{rel?}', 'ActiveController@userInfo')->name('active.userinfo');
    $route->any('/{merchant}/{token}/lottery/{rel?}', 'ActiveController@lottery')->name('active.lottery');
    $route->get('/{merchant}/{token}/{rel?}', 'ActiveController@index')->name('active.index');
});

//分享
Route::prefix('api/')->namespace('Front')->group(function ($route) {
    $route->any('/wxshare/{merchant?}/', 'WeiXinShareController@api')->name('api.weixin.share');
});
?>