<?php

/*搜索*/
Route::get('/posts/search', 'PostController@search')->name('search');

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
// 文章评论
Route::post('posts/{post}/comment', 'PostController@comment')->name('posts.comment');

/* 用户模块*/
// 用户注册
Route::get('register', 'RegisterController@index')->name('register.index');
Route::post('register', 'RegisterController@store')->name('register.store');
// 登录
Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@store')->name('login.store');
// 登出
Route::get('logout', 'LoginController@logout')->name('logout');


/*用户个人中心*/
// 个人设置页面
Route::get('user/me/setting', 'UserController@setting')->name('user.setting');
// 个人设置操作
Route::post('user/me/setting', 'UserController@settingStore')->name('user.settingStore');
// 个人中心
Route::get('user/{user}', 'UserController@show')->name('user.show');
// 关注与取消关注
Route::post('user/{user}/follow', 'UserController@follow')->name('user.follow');
Route::post('user/{user}/unFollow', 'UserController@unFollow')->name('user.unFollow');


/*点赞模块*/
Route::get('posts/{post}/zan', 'PostController@zan')->name('posts.zan');
Route::get('posts/{post}/unzan', 'PostController@unzan')->name('posts.unzan');


/*专题模块*/
// 专题详情页
Route::get('topic/{topic}', 'TopicController@show')->name('topic.show');
// 投稿
Route::post('topic/{topic}/submit', 'TopicController@submit')->name('topic.submit');


include_once 'admin.php';