<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Services\UserService;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function CreateUser(Request $request)
    {
        $usuario = $this->userService->createUser($request->all());
        return response()->json($usuario, 201);
    }

    public function UpdateUser(Request $request, $id)
    {
        try {
            $usuario = $this->userService->updateUser($request->all(), $id);
            return response()->json($usuario, 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Datos de validación inválidos', 'details' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'No se pudo actualizar el usuario'], 500);
        }
    }

    public function DeleteUser($id)
    {
        try {
            $this->userService->deleteUser($id);
            return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar el usuario'], 500);
        }
    }

    public function GetUsers()
    {
        try {
            $usuarios = $this->userService->getUsers();
            return response()->json($usuarios, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'No pudimos encontrar los usuarios'], 500);
        }
    }

    public function GetUser($id)
    {
        try {
            $usuario = $this->userService->getUser($id);
            return response()->json($usuario, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }
}