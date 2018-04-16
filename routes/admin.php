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
    Route::post('users/store', 'Admin\UserController@store')->name('adminUser.store');


    // 文章管理模块
    Route::get('posts', 'Admin\PostController@index')->name('adminPost.index');
    Route::post('posts/{post}/status', 'Admin\PostController@status')->name('adminPost.status');


    /* 角色模块 */
    // 角色列表页
    Route::get('roles', 'Admin\RoleController@index')->name('role.index');
    // 角色创建
    Route::get('roles/create', 'Admin\RoleController@create')->name('role.create');
    Route::post('roles/store', 'Admin\RoleController@store')->name('role.store');

    // 角色 & 用户 关联
    Route::get('users/{user}/role', 'Admin\UserController@role')->name('adminUser.role');
    Route::post('users/{user}/role', 'Admin\UserController@storeRole')->name('adminUser.storeRole');
    // 权限 & 角色 关联
    Route::get('roles/{role}/permission', 'Admin\RoleController@permission')->name('role.permission');
    Route::post('roles/{role}/permission', 'Admin\RoleController@storePermission')->name('role.storePermission');

    /* 权限模块 */
    // 权限列表页
    Route::get('permissions', 'Admin\PermissionController@index')->name('permission.index');
    // 权限创建
    Route::get('permissions/create', 'Admin\PermissionController@create')->name('permission.create');
    Route::post('permissions/store', 'Admin\PermissionController@store')->name('permission.store');

});