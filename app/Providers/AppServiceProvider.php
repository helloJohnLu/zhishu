<?php

namespace App\Providers;

use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');
        // 视图合成器
        \View::composer('layouts._sidebar', function ($view) {
            $topics = Topic::all();
            $view->with('topics', $topics); // 注入专题模型
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
