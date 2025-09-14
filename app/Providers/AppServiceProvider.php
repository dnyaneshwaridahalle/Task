<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Share a global $hasPermission function to all views
        View::composer('*', function ($view) {
            $roleId = Auth::check() ? Auth::user()->role_id : null;

            $hasPermission = function ($moduleSlug, $permissionSlug) use ($roleId) {
                if (!$roleId) return false;

                return DB::table('role_module_permission')
                    ->join('modules', 'modules.id', '=', 'role_module_permission.module_id')
                    ->join('permissions', 'permissions.id', '=', 'role_module_permission.permission_id')
                    ->where('role_module_permission.role_id', $roleId)
                    ->where('modules.slug', $moduleSlug)
                    ->where('permissions.slug', $permissionSlug)
                    ->exists();
            };

            $view->with('hasPermission', $hasPermission);
        });
    }
}
