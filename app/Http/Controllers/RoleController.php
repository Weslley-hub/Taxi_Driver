<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Http\Controllers\PermissionController;


class RoleController extends Controller
{
    public function index(){

       
        $roles = Role::All();   
        return view('roles.index', compact('roles'));

        
    }


    public function create()
    {
        
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|min:3', 
            'status' => 'required|in:0,1', // Validação para garantir que o status seja 0 ou 1
        ]);
    
        // Cria uma nova instância de Role com os dados do formulário
        $role = new Role([
            'name' => $request->name,
            'status' => $request->status,
        ]);
    
        // Salva a nova função no banco de dados
        $role->save();
    
        $this->givePermission($request, $role);
        $message = 'Role updated successfully';
        return back()->with(compact('role', 'message'));
}
// public function destroy($id)
// {
//     $role = Role::findOrFail($id); // Busca a role pelo ID
//     $role->syncPermissions([]); // Revoga todas as permissões da role

//     return redirect()->route('admin.roles.index')->with('success', 'Permissions revoked successfully');
// }
    
        public function edit(Role $role)
        {
            $permissions = Permission::all();
            return view('roles.create', compact('role', 'permissions'));
        }   
    
        public function update(Request $request, $id)
        {
            
    
            $request->validate([
                'name' => 'required|unique:roles,name,'.$id,
                // Outras regras de validação, se necessário
            ]);
        
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->status = $request->status;
            // Atualize outras propriedades conforme necessário
        
            $role->save();
            $this->givePermission($request, $role);
            $message = 'Role updated successfully';
            return back()->with(compact('role', 'message'));
        }
    
        public function givePermission(Request $request, Role $role)
        {
            
             // Remove todas as permissões atribuídas anteriormente para esta função
    $role->syncPermissions([]);

    // Obtém os IDs das permissões selecionadas no formulário
    $permissionIds = $request->input('permission', []);

    // Atribui as permissões selecionadas para esta função
    foreach ($permissionIds as $permissionId) {
        $permission = Permission::find($permissionId);
        if ($permission) {
            $role->givePermissionTo($permission);
        }
    }
        }

        public function removeRole(Role $role, Permission $permission)
        {

            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
                return back()->with('message', 'Permissão Revogada');
            }
            return back()->with('message', 'A permissão não existe');
        }

        public function toggleRole($id)
    {
        $role = Role::findOrFail($id);
        $role->status = $role->status == 1 ? 0 : 1;
        $role->save();
    
        return redirect()->route('admin.roles.index')->with('success', 'Utilizador status atualizado com sucesso.');
    }

}
