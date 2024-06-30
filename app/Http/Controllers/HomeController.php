<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Travel;  


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         // Verifica se o usuário está autenticado
         if (Auth::check()) {
            // Obtém o tipo de usuário do modelo User
            $userType = Auth::user()->userType;

            // Escolhe o layout com base no tipo de usuário
            $layout = ($userType == 'Administrador') ? 'layouts.outer' : 'layouts.sidetaxi';
            $users = User::all();
            $travel = Travel::all();

            // Retorna a vista com o layout escolhido
            return view('welcome', compact('layout', 'users', 'travel'));
        }

    }
}
