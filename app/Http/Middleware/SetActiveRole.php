<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetActiveRole
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user  = auth()->user();
        $roles = $user->getRoleNames();

        // ❌ active_role tidak valid → hapus
        if (session()->has('active_role') && !$roles->contains(session('active_role'))) {
            session()->forget('active_role');
        }

        // ✅ hanya 1 role → auto set
        if ($roles->count() === 1) {
            session(['active_role' => $roles->first()]);
        }

        // ⚠️ lebih dari 1 role tapi belum pilih
        if ($roles->count() > 1 && !session()->has('active_role')) {
            session(['need_choose_role' => true]);
        } else {
            session()->forget('need_choose_role');
        }

        return $next($request);
    }
}
