<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('user.dataUser', ['users' => $users], ['roles' => $roles]);
    }

    

    public function taxistas()
    {
        $users = User::where('role_id', '2')->get();
        return view('taxi.dataTaxistas', compact('users'));
    }
    public function showForm()
    {
        return view('taxi.formTaxistas');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validação dos dados do formulário
         $validatedData = $request->validate([
             'name' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:6',
             'password_confirmation' => 'required|same:password', // 'password_confirmation' => 'required|same:password
             'role_id' => 'required',
             'commissionAmount' => 'required|numeric',    
             'status' => 'required',
         ]);

        // Criptografar a senha do usuário
        $hashedPassword = Hash::make($validatedData['password']);

        $role = Role::findOrFail($validatedData['role_id']);

        // Criar um novo objeto User com os dados validados
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'], 
            'commissionAmount' => $validatedData['commissionAmount'],
            'status' => $validatedData['status'],
            'password' => $hashedPassword,
            'role_id' => $role->id,
        ]);
        
        // Salvar o objeto User no banco de dados
        $user->save();

        
        // Atribuir a role ao usuário
        $user->assignRole($role);

        // Redirecionar para a página de listagem de usuários

        // Redirecionar para a página de listagem de usuários
        if ($user->save()) {
            return redirect()->route('admin.user.create')->with('success', 'Utilizador criado com sucesso.');
        } else {
            return redirect()->route('admin.user.create')->with('error', 'Por favor, preencha todos os campos corretamente.');
        }

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.create', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // // Valida os dados recebidos do formulário
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,' . $user->id,
        //     'password' => 'nullable|min:6',
        //     'comissionAmount' => 'required|numeric',
        //     'status' => 'required|in:active,inactive',
        //     'role' => 'required|exists:roles,name',
        // ]);

        $role = Role::findOrFail($request['role_id']);


        // Atualiza os campos do usuário com os dados validados
        $user->name = $request['name'];
        $user->email = $request['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($request['password']);
        }
        $user->commissionAmount = $request['commissionAmount'];
        $user->status = $request['status'];
        
        // Salva as alterações no banco de dados
        $user->save();

        // Atualizar a role do usuário
        $user->syncRoles($role);

        // Redireciona para a página de detalhes do usuário atualizado
        return redirect()->route('admin.user.edit', $user->id)->with('success', 'Utilizador atualizado com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
    
        return redirect()->route('admin.user.index')->with('success', 'Utilizador status atualizado com sucesso.');
    }
    
}
