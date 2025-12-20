<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActiveRolePermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $role = session('active_role');

        abort_if(
            !$role || !auth()->user()->hasPermissionTo($permission, $role),
            403
        );

        return $next($request);
    }
}

