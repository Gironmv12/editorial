<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Función para autenticar al usuario
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'contrasena' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->contrasena, $usuario->contrasena)) {
            Log::warning('Intento de login fallido para el email: ' . $request->email);
            return redirect()->back()->withErrors(['error' => 'Credenciales inválidas']);
        }

        // Almacenar el ID del usuario, nombre del usuario y el rol en la sesión
        session([
            'id_usuario' => $usuario->id_usuario,
            'nombre_usuario' => $usuario->nombre_usuario,
            'rol' => $usuario->rol,
            'email_usuario' => $usuario->email
        ]);

        // Opcional: Generar el token si es necesario
        // $token = $usuario->createToken('login_token')->plainTextToken;

        return redirect('/')->with('success', 'Inicio de sesión exitoso');
    }

    // Función para destruir el token de autenticación y la sesión del usuario (logout)
    public function logoutUser(Request $request)
    {
        // Eliminar el token actual si estás utilizando tokens
        // $request->user()->currentAccessToken()->delete();

        // Eliminar el nombre del usuario y el rol de la sesión
        session()->forget(['nombre_usuario', 'rol']);

        return redirect('/')->with('success', 'Sesión cerrada exitosamente');
    }
}