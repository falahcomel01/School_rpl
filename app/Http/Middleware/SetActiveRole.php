<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetActiveRole
{
 public function handle($request, Closure $next)
{
    if (!auth()->check()) {
        return $next($request);
    }

    $roles = auth()->user()->getRoleNames();

    // Jika cuma 1 role → auto set
    if ($roles->count() === 1) {
        session(['active_role' => $roles->first()]);
    }

    // Kalau >1 role & belum pilih
    if ($roles->count() > 1 && !session()->has('active_role')) {
        session(['need_choose_role' => true]);
    }

    return $next($request);
}

}
