<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogo;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class CatalogosController extends Controller
{
    //crear un nuevo catalogo usando el modelo Catalogo
    public function createCatalogo(Request $request){
        try {
            $validated = $request->validate([
                'nombre_catalogo' => 'required|string|max:255',
            ]);

            $catalogo = Catalogo::create($validated);
            return response()->json($catalogo, 201);
        } catch (ValidationException $e) {
            Log::error('Validation error while creating catalogo: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return response()->json(['message' => 'Datos de entrada inválidos', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating catalogo: ' . $e->getMessage());
            return response()->json(['message' => 'Error al crear el catálogo'], 500);
        }
    }

    //editar un catalogo existente
    public function updateCatalogo(Request $request, $id){
        try {
            $catalogo = Catalogo::findOrFail($id);

            $validated = $request->validate([
                'nombre_catalogo' => 'required|string|max:255',
            ]);

            $catalogo->update($validated);
            return response()->json($catalogo, 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos de entrada inválidos', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el catálogo'], 500);
        }
    }

    //obtener todos los catalogos
    public function getCatalogos(){
        try {
            $catalogos = Catalogo::where('eliminado', 0)->get();
            return response()->json($catalogos);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los catálogos'], 500);
        }
    }

    //obtener un catalogo por id
    public function getCatalogo($id){
        try {
            $catalogo = Catalogo::findOrFail($id);
            return response()->json($catalogo);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el catálogo'], 500);
        }
    }

    //eliminar un catalogo por id
    public function deleteCatalogo($id){
        try {
            $catalogo = Catalogo::findOrFail($id);
            $catalogo->update(['eliminado' => 1]);
            return response()->json(['message' => 'Catálogo eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el catálogo'], 500);
        }
    }
}