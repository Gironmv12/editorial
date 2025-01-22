<?php

namespace App\Http\Controllers\Deseos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deseo;
use App\Models\Libro;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;

class DeseosController extends Controller
{
    //funcion para cuando el usuario haga click en el boton deseos el libro se guarde a la tabla "deseos" con los campos" id_deseo, id_usuario, id_libro"
    public function CreateDeseo(Request $request) {
        Log::info('CreateDeseo called', ['request' => $request->all()]);

        // Validar los datos de entrada
        $request->validate([
            'id_libro' => 'required|integer|exists:libros,id_libro'
        ]);

        Log::info('Validation passed for CreateDeseo');

        //verificar si esta logueado id_usuario
        if (!session()->has('id_usuario')) {
            Log::error('User not logged in');
            return response()->json(['message' => 'Usuario no logueado'], 401);
        }

        // Verificar si el deseo ya existe
        $existe = Deseo::where('id_usuario', session('id_usuario'))
                       ->where('id_libro', $request->id_libro)
                       ->exists();

        if ($existe) {
            return response()->json(['message' => 'El deseo ya existe'], 400);
        }

        try {
            $deseo = new Deseo();
            $deseo->id_usuario = session('id_usuario');
            $deseo->id_libro = $request->id_libro;
            $deseo->save();

            Log::info('Deseo created successfully', ['deseo_id' => $deseo->id]);

            return response()->json(['message' => 'Deseo creado correctamente'], 200);
        } catch (\Exception $e) {
            Log::error('Error creating Deseo', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Error al crear el deseo', 'error' => $e->getMessage()], 500);
        }
    }

    //obtener los deseos especificos de un solo usuario sin autenticacion
    public function GetDeseos($id) {
        Log::info('GetDeseos called', ['id' => $id]);

        // Verificar si el usuario existe
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Obtener los deseos del usuario
        $deseos = Deseo::where('id_usuario', $id)
                       ->with('libro')
                       ->get();

        return response()->json($deseos, 200);
    }
}