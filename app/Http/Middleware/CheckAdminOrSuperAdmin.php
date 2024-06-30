<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class CheckAdminOrSuperAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && in_array($user->role_id, [1, 3])) { // IDs 1 e 2 representam Admin e SuperAdmin
            return $next($request);
        }

        return redirect('/welcome')->with('error', 'Acesso negado. Você não tem permissão para acessar esta página.');
    }
}
