<?php
/* 后台路由 */

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', function () {
        return 'login';
    });
});