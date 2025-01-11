<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    //funcion para registrar el usuario
    public function registerUser(Request $request)
    {
        $this->validateUser($request);

        try {
            $usuario = $this->createUser($request);
            $token = $this->generateToken($usuario);

            return redirect()->route('loginpage')->with('success', 'Usuario creado exitosamente. Por favor inicie sesión');
        } catch (\Exception $e) {
            Log::error('Error creating user', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Error creating user'], 500);
        }
    }

    private function validateUser(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'contrasena' => 'required|string|min:8',
            //rol por defecto "user"
            'rol' => 'string|in:user,admin',
        ]);
    }

    private function createUser(Request $request)
    {
        return Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'contrasena' => Hash::make($request->contrasena),
            'rol' => $request->rol ?? 'user',
        ]);
    }

    private function generateToken(Usuario $usuario)
    {
        return $usuario->createToken('token')->plainTextToken;
    }

}