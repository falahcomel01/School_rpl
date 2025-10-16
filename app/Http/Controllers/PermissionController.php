<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PermissionController extends Controller implements HasMiddleware
{
         public static function middleware(): array
 {
    return [
new Middleware('permission:view permissions',only:['index']),
new Middleware('permission:edit permissions',only:['edit']),
new Middleware('permission:create permissions',only:['create']),
new Middleware('permission:delete permissions',only:['destroy']),
    ];
 }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('id','asc')->paginate(10);
        return view('permissions.list',[
        'permissions' => $permissions
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
          'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()){
         permission::create(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('berhasil','berhasil tambah');


        }else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
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
        $permissions = Permission::findOrfail($id);
         return view('permissions.edit',[
            'permissions' => $permissions
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permissions = Permission::findOrfail($id);
        $validator = Validator::make($request->all(),[
          'name' => 'required|min:3|unique:permissions,name,$id,id'
        ]);

        if ($validator->passes()){
            //permission::create(['name' => $request->name]);
         $permissions->name = $request->name;
         $permissions->save();
        return redirect()->route('permissions.index')->with('berhasil','berhasil tambah');
        }else {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $permissions = Permission::find($id);

    if (! $permissions) {
        return redirect()
        ->route('permissions.index')->with('eror','permission ga ada');

    }
    $name = $permissions->name;
    $permissions->delete();

     return redirect()
        ->route('permissions.index')->with('succes',"permission'{$name}'udah dihapus");
    
}
    }
    
