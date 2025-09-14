<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $moduleSlug, $permissionSlug)
    {
        $user = Auth::user();

        // Super admin bypass
        if ($user->role_id == 1 || $user->role_id == 2) { // Assuming role_id 1 = Admin
            return $next($request);
        }

        $query = DB::table('role_module_permission')
            ->join('modules', 'modules.id', '=', 'role_module_permission.module_id')
            ->join('permissions', 'permissions.id', '=', 'role_module_permission.permission_id')
            ->where('role_module_permission.role_id', $user->role_id)
            ->where('modules.slug', $moduleSlug)
            ->where('permissions.slug', $permissionSlug);

        // Get the raw SQL with placeholders
        $sql = $query->toSql();

        // Get the bindings (values that replace ?)
        $bindings = $query->getBindings();

        // Convert bindings into query
        $fullQuery = vsprintf(str_replace('?', '%s', $sql), array_map(function ($binding) {
            return is_numeric($binding) ? $binding : "'$binding'";
        }, $bindings));

        dd($fullQuery);



        if (!$hasPermission) {
            return redirect()->route('dashboard')
                ->with('error', "You do not have access to the '{$moduleSlug}' module.");
        }

        return $next($request);
    }
}
