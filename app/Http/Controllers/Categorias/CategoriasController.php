<?php

namespace App\Http\Controllers\Categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CategoriasController extends Controller
{
    // Mostrar todas las categorías
    public function getCategorias()
    {
        try {
            $categorias = Categoria::where('eliminado', 0)->get();
            return response()->json($categorias);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener las categorías'], 500);
        }
    }

    // Crear una nueva categoría
    public function createCategorias(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre_categoria' => 'required|string|max:255',
            ]);

            $categoria = Categoria::create($validated);
            return response()->json($categoria, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos de entrada inválidos', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la categoría'], 500);
        }
    }

    // Mostrar una categoría específica
    public function getCategoria($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            return response()->json($categoria);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener la categoría'], 500);
        }
    }

    // Actualizar una categoría existente
    public function updateCategoria(Request $request, $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);

            $validated = $request->validate([
                'nombre_categoria' => 'sometimes|required|string|max:255',
            ]);

            $categoria->update($validated);
            return response()->json($categoria);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos de entrada inválidos', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la categoría'], 500);
        }
    }

    // Eliminar una categoría
    public function deleteCategoria($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->update(['eliminado' => 1]);
            return response()->json(['message' => 'Categoría eliminada']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la categoría'], 500);
        }
    }
}