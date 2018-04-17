<?php

namespace App\Providers;

use App\Models\AdminPermission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy', // 文章策略授权
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 注册权限 Gate
        $permissions = AdminPermission::all();
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }

    protected function getPermissions()
    {
        try {
            return Permission::with('roles')->get();
        } catch (\Exception $e) {
            return [];
        }
    }
}
