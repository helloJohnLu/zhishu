<?php

/* 文章模块 */
Route::resource('posts', 'PostController');
// URL跳转
Route::get('posts', function () {
    return redirect()->route('posts.index');
});
// 首页
Route::get('/', 'PostController@index')->name('posts.index');

// 文章图片上传
Route::post('posts/image/upload', 'PostController@imageUpload')->name('posts.imageUpload');


/* 用户模块*/
// 用户注册
Route::get('register', 'RegisterController@index')->name('register.index');
Route::post('register', 'RegisterController@store')->name('register.store');
// 登录
Route::get('login', 'LoginController@index')->name('login.index');
Route::post('login', 'LoginController@store')->name('login.store');
// 登出
Route::get('logout', 'LoginController@logout')->name('login.logout');
// 个人设置页面
Route::get('user/me/setting', 'UserController@setting')->name('user.setting');
// 个人设置操作
Route::post('user/me/setting', 'UserController@settingStore')->name('user.settingStore');

