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
         $roles = Role::orderBy('name','asc')->paginate(10);

       return view('roles.list',[
        'roles' => $roles 
          ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name','ASC')->get();
       return view('roles.create',[
        'permissions' => $permissions
       ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:roles|min:2'
    ]);

    if ($validator->passes()) {
        $role = Role::create(['name' => $request->name]);

        // ✅ perbaiki bagian ini
        if (!empty($request->permission)) {
            foreach ($request->permission as $permName) {
                $role->givePermissionTo($permName);
            }
        }

        return redirect()->route('roles.index')->with('berhasil', 'Role berhasil ditambahkan.');
    } else {
        return redirect()->route('roles.create')->withInput()->withErrors($validator);
    }
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
        $roles = Role::findOrfail($id);
        $hasPermissions = $roles->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();
         return view('roles.edit',[
            'roles' => $roles,
         'permissions' => $permissions,
         'hasPermission' =>$hasPermissions
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roles = Role::findOrfail($id);
        $validator = Validator::make($request->all(),[
          'name' => 'required|min:3|unique:roles,name,'. $id .',id'
        ]);

        if ($validator->passes()){
            $roles->name = $request->name;
            $roles->save();
        

        if (!empty($request->permission)){
            $roles->syncPermissions($request->input('permission',[]));
        }
        return redirect()->route('roles.index')->with('berhasil','berhasil update');
        }else {
            return redirect()->route('roles.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $roles = Role::find($id);

    if (! $roles) {
        return redirect()
        ->route('permissions.index')->with('eror','permission ga ada');

    }
    $name = $roles->name;
    $roles->delete();

    return redirect()
        ->route('roles.index',"Role'{$name}'udah dihapus");
    
    }
}
