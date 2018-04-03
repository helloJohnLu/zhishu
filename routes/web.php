<?php

// 文章模块
Route::resource('posts', 'PostController');
// URL跳转
Route::get('posts', function () {
    return redirect()->route('posts.index');
});
// 首页
Route::get('/', 'PostController@index')->name('posts.index');

// 文章图片上传
Route::post('posts/image/upload', 'PostController@imageUpload')->name('posts.imageUpload');




