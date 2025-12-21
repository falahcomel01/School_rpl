<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckActiveRolePermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $activeRole = session('active_role');
        $user = auth()->user();

        // Belum pilih role
        abort_if(!$activeRole, 403, 'Role aktif belum dipilih');

        // User TIDAK punya role aktif tsb
        abort_if(!$user->hasRole($activeRole), 403);

        // Permission harus dimiliki ROLE AKTIF
        $rolePermissions = $user
            ->roles
            ->where('name', $activeRole)
            ->first()
            ?->permissions
            ->pluck('name')
            ->toArray() ?? [];

        abort_if(!in_array($permission, $rolePermissions), 403);

        return $next($request);
    }
}
