<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:show roles', only: ['show']),
            new Middleware('permission:edit roles', only: ['edit', 'update']),
            new Middleware('permission:create roles', only: ['create', 'store']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    /**
     * 🧾 Tampilkan daftar role
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name', 'asc')->paginate(10);

        return view('roles.list', compact('roles'));
    }

    /**
     * ➕ Form tambah role baru
     */
    public function create()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', compact('permissions'));
    }

    /**
     * 💾 Simpan role baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }

        $role = Role::create(['name' => $request->name]);

        if (!empty($request->permission)) {
            foreach ($request->permission as $permName) {
                $role->givePermissionTo($permName);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * ✏️ Form edit role
     */
    public function edit(string $id)
    {
        $roles = Role::findOrFail($id);
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $hasPermissions = $roles->permissions->pluck('name');

        return view('roles.edit', compact('roles', 'permissions', 'hasPermissions'));
    }

    /**
     * 🔄 Update data role
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.edit', $role->id)
                ->withInput()
                ->withErrors($validator);
        }

        $role->update(['name' => $request->name]);

        // Ambil permission dari request, default ke array kosong jika tidak ada
        $permissions = $request->input('permission', []);

        // Selalu sync — bahkan jika kosong!
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * 🗑️ Hapus role
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role tidak ditemukan.');
        }

        $name = $role->name;
        $role->delete();

        return redirect()->route('roles.index')->with('success', "Role '{$name}' berhasil dihapus.");
    }
}
