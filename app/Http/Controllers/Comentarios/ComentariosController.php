<?php

namespace App\Http\Controllers\Comentarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;

class ComentariosController extends Controller
{
    //funcion para Añadir un comentario
    public function addComentario(Request $request){
        if (!Auth::check()) {
            return response()->json(['error' => 'Por favor, inicie sesión para agregar un comentario.'], 401);
        }

        $request->validate([
            'id_libro' => 'required|integer|exists:libros,id_libro',
            'comentario' => 'required|string|max:1000',
        ]);

        $usuario = Auth::user();

        Comentario::create([
            'id_libro' => $request->id_libro,
            'id_usuario' => $usuario->id_usuario,
            'nombre' => $usuario->nombre_usuario,
            'comentario' => $request->comentario,
        ]);

        return response()->json(['message' => 'Comentario agregado exitosamente.'], 201);
        
    }
}