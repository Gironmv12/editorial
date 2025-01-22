<?php
namespace App\Services;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        $validatedData = validator($data, [
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'contrasena' => 'required|string|min:6',
            //rol por default user y no es requerido
            'rol' => 'sometimes|string|in:user,admin',
        ])->validate();

        $usuario = Usuario::create([
            'nombre_usuario' => $validatedData['nombre_usuario'],
            'email' => $validatedData['email'],
            'contrasena' => Hash::make($validatedData['contrasena']),
            'rol' => $validatedData['rol'] ?? 'user',
        ]);

        return $usuario; // Asegura que se devuelve el objeto Usuario con id_usuario
    }

    public function updateUser(array $data, $id)
    {
        $validatedData = validator($data, [
            'nombre_usuario' => 'sometimes|string|max:255',
            'email' => "sometimes|email|unique:usuarios,email,{$id},id_usuario",
            'contrasena' => 'sometimes|string|min:6',
            'rol' => 'sometimes|string|in:user,admin',
        ])->validate();

        $usuario = Usuario::findOrFail($id);

        if (isset($validatedData['contrasena'])) {
            $validatedData['contrasena'] = Hash::make($validatedData['contrasena']);
        }

        $usuario->update($validatedData);

        return $usuario;
    }

    public function deleteUser($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return true;
    }

    public function getUsers()
    {
        return Usuario::all();
    }

    public function getUser($id)
    {
        return Usuario::findOrFail($id);
    }
}