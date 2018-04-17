<?php

/*搜索*/
Route::get('/posts/search', 'PostController@search')->name('search');

/* 文章模块 */
Route::resource('posts', 'PostController');
// URL跳转
/*Route::get('posts', function () {
    return redirect()->route('posts.index');
});*/
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


/* 通知模块 */
Route::get('notices', 'NoticeController@index');


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

    /* 角色权限 */
    Route::group(['middleware' => 'can:system'], function () {
        // 管理人员模块
        Route::get('users', 'Admin\UserController@index')->name('adminUser.index');
        Route::get('users/create', 'Admin\UserController@create')->name('adminUser.create');
        Route::post('users/store', 'Admin\UserController@store')->name('adminUser.store');

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

    Route::group(['middleware' => 'can:post'], function () {
        // 文章管理模块
        Route::get('posts', 'Admin\PostController@index')->name('adminPost.index');
        Route::post('posts/{post}/status', 'Admin\PostController@status')->name('adminPost.status');
    });


    /* 专题模块 */
    Route::group(['middleware' => 'can:topic'], function () {
        Route::resource('topics', 'Admin\TopicController', ['only' => ['index', 'create', 'store', 'destroy']]);
    });


    /* 通知模块 */
    Route::group(['middleware' => 'can:notice'], function () {
        Route::resource('notices', 'Admin\NoticeController', ['only' => ['index', 'create', 'store']]);
    });
});