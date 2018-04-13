<?php
/* 后台路由 */

Route::group(['prefix' => 'admin'], function () {
    // 登录页面
    Route::get('login', 'Admin\LoginController@index')->name('adminLogin.index');

    // 登录提交
    Route::post('login', 'Admin\LoginController@login')->name('adminLogin.login');

    // 登出
    Route::get('logout', 'Admin\LoginController@logout')->name('adminLogin.logout');
});