<?php

// 文章模块
Route::resource('posts', 'PostController');
// 文章图片上传
Route::post('posts/image/upload', 'PostController@imageUpload')->name('posts.imageUpload');


