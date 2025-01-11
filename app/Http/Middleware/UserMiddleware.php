<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session()->has('rol') || session('rol') !== 'user'){
            return redirect()->route('home')->with('error', 'Debes iniciar sesión');
        }

        if($request->session()->get('rol') !== 'user'){
            return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta página');
            
        }
        return $next($request);
    }
}