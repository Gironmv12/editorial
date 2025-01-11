<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //verificar si el usuario esta autenticado
        if (!session()->has('rol')){
            return redirect('/')->with('error', 'Debes iniciar sesión');
        }

        //verificar si el usuario es administrador
        if (session('rol') !== 'admin'){
            return redirect('/')->with('error', 'No tienes permisos para acceder a esta página');
        }
        return $next($request);
    }
}