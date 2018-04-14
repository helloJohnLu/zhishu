<?php
/* 后台路由 */

Route::group(['prefix' => 'admin'], function () {
    // 登录页面
    Route::get('login', 'Admin\LoginController@index')->name('adminLogin.index');
    // 登录提交
    Route::post('login', 'Admin\LoginController@login')->name('adminLogin.login');
    // 登出
    Route::get('logout', 'Admin\LoginController@logout')->name('adminLogin.logout');

    // 首页
    Route::get('home', 'Admin\HomeController@index')->name('adminHome.index');

    // 管理人员模块
    Route::get('users', 'Admin\UserController@index')->name('adminUser.index');
    Route::get('users/create', 'Admin\UserController@create')->name('adminUser.create');
    Route::post('user/store', 'Admin\UserController@store')->name('adminUser.store');

    // 文章管理模块
    Route::get('posts', 'Admin\PostController@index')->name('adminPost.index');
    Route::post('posts/{post}/status', 'Admin\PostController@status')->name('adminPost.status');
});