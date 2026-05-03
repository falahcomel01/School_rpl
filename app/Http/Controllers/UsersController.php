<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class UsersController extends Controller //implements HasMiddleware
{
    
 public static function middleware(): array
 {
    return [
new Middleware('permission:view roles',only:['index']),
new Middleware('permission:edit roles',only:['edit']),
new Middleware('permission:create roles',only:['create']),
new Middleware('permission:delete roles',only:['destroy']),
    ];
 }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('Users.list', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name', 'ASC')->get();

        return view('Users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withInput()
                ->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();

        // assign role kalau ada
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('berhasil', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id')->toArray();

        return view('Users.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRole' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|unique:users,username,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        $user->syncRoles($request->input('role', []));
        return redirect()->route('users.index')->with('berhasil', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.index')->with('error', 'User tidak ditemukan');
    }

    if ($user->hasRole('superadmin')) {
        return redirect()->route('users.index')->with('error', 'Role Superadmin tidak bisa dihapus');
    }

    $user->delete();
    return redirect()->route('users.index')->with('berhasil', 'User berhasil dihapus');
}
}
