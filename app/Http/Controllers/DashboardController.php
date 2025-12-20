<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
   public function index()
{
    $activeRole = session('active_role');

    // Data hanya untuk superadmin
    $usersCount = null;
    $rolesCount = null;
    $permissionsCount = null;

    if ($activeRole === 'superadmin') {
        $usersCount = User::count();
        $rolesCount = Role::count();
        $permissionsCount = Permission::count();
    }

    return view('dashboard', compact(
        'usersCount',
        'rolesCount',
        'permissionsCount'
    ));
}


    // ================= ADMIN =================
   protected function adminDashboard()
{
    $usersCount = User::count();
    $rolesCount = Role::count();
    $permissionsCount = Permission::count();

    $labels = ['User', 'Role', 'Permission'];
    $dataSet = [$usersCount, $rolesCount, $permissionsCount];

    return view('dashboard.admin', compact(
        'usersCount',
        'rolesCount',
        'permissionsCount',
        'labels',
        'dataSet'
    ));
}


    // ================= GURU ==================
    protected function guruDashboard()
    {
        return view('dashboard.guru');
    }

    // ================= WALI KELAS ============
    protected function waliKelasDashboard()
    {
        return view('dashboard.walikelas');
    }
}
