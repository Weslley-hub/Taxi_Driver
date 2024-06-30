<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionController extends Controller
{
    public function index(){

        $permissions = Permission::all();
        $roles = Role::all();
        return view('permissions.index', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
            'status' => 'required|in:0,1',
        ]);

        Permission::create(['name' => $request->name]);
        return redirect()->route('admin.permissions.create')->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $permission = Permission::find($id);
    $roles = Role::all();
    $allPermissions = Permission::all();

    return view('admin.permissions.create', compact('permission', 'roles', 'allPermissions'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('permissions.create', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->status = $request->status;
        $permission->save();

        return redirect()->route('admin.permissions.create')->with('success', 'Permission updated successfully'); 


    }

    /**
     * Remove the specified resource from storage.
      */
    // public function destroy(string $id)
    // {
    //     $permission = Permission::findOrFail($id);
    //     $permission->status = 0;
    //     $permission->save();

    //     return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully');
    // }

    public function togglePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->status = $permission->status == 1 ? 0 : 1;
        $permission->save();
    
        return redirect()->route('admin.permissions.index')->with('success', 'Utilizador status atualizado com sucesso.');
    }
}

