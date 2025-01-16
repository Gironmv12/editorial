<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class BooksController extends Controller
{
    // Obtener todos los libros
    public function getBooks(){
        try {
            $libros = Libro::with(['categorias', 'catalogos'])->get();
            $total = $libros->count();
            return response()->json(['libros' => $libros, 'total' => $total], 200);
        } catch (Exception $e) {
            Log::error('Error al obtener los libros: '.$e->getMessage());
            return response()->json(['message' => 'Error al obtener los libros. Intente nuevamente más tarde.'], 500);
        }
    }
    
    // Obtener un libro por id
    public function getBook($id){
        try {
            // Cargar las relaciones 'categorias' y 'catalogos' con el libro
            $libro = Libro::with(['categorias', 'catalogos'])->findOrFail($id);
            return response()->json(['libro' => $libro], 200);
        } catch (ModelNotFoundException $e) {
            Log::warning('Libro no encontrado con ID: '.$id);
            return response()->json(['message' => 'Libro no encontrado'], 404);
        } catch (Exception $e) {
            Log::error('Error al obtener el libro: '.$e->getMessage());
            return response()->json(['message' => 'Error al obtener el libro. Intente nuevamente más tarde.'], 500);
        }
    }
    
    // Crear un libro
    public function createBooks(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'titulo' => 'required|string|max:255',
                'isbn' => 'required|string|min:10|max:18|unique:libros',
                'calificacion' => 'nullable|numeric',
                'autor' => 'required|string|max:500',
                'coordinado_por' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string',
                'detalle' => 'nullable|string',
                'archivo_pdf' => 'nullable|mimes:pdf|max:20000',
                'archivo_epub' => 'nullable|mimes:epub|max:20000',
                'precio' => 'nullable|numeric',
                'tipo' => 'required|string|max:50',
                'desactivar' => 'nullable|boolean',
                'categorias' => 'nullable|array',
                'categorias.*' => 'integer|exists:categorias,id_categoria',
                'catalogos' => 'nullable|array',
                'catalogos.*' => 'integer|exists:catalogos,id_catalogo',
            ]);
    
            if ($validator->fails()) {
                Log::warning('Validación fallida al crear el libro: ', $validator->errors()->toArray());
                return response()->json(['errors' => $validator->errors()], 400);
            }
            
            // Manejar la carga de imagen
            if ($request->file('imagen')) {
                Log::info('Iniciando la carga de la imagen del libro.');
                $imagenPath = $request->file('imagen')->store('images/libros', 'public');
                Log::info('Imagen subida exitosamente: ' . $imagenPath);
            } else {
                Log::info('No se proporcionó imagen para el libro.');
                $imagenPath = null;
            }
            
            // Manejar la carga de archivo PDF
            if ($request->file('archivo_pdf')) {
                try {
                    Log::info('Iniciando la carga del archivo PDF del libro.');
                    $pdfPath = $request->file('archivo_pdf')->store('archivos/pdf', 'public');
                    Log::info('Archivo PDF subido exitosamente: ' . $pdfPath);
                } catch (Exception $e) {
                    Log::error('Error al subir el archivo PDF: ' . $e->getMessage());
                    return response()->json(['message' => 'Error al subir el archivo PDF.'], 500);
                }
            } else {
                Log::info('No se proporcionó archivo PDF para el libro.');
                $pdfPath = null;
            }
    
            // Manejar la carga de archivo EPUB
            if ($request->file('archivo_epub')) {
                try {
                    Log::info('Iniciando la carga del archivo EPUB del libro.');
                    $epubPath = $request->file('archivo_epub')->store('archivos/epub', 'public');
                    Log::info('Archivo EPUB subido exitosamente: ' . $epubPath);
                } catch (Exception $e) {
                    Log::error('Error al subir el archivo EPUB: ' . $e->getMessage());
                    return response()->json(['message' => 'Error al subir el archivo EPUB.'], 500);
                }
            } else {
                Log::info('No se proporcionó archivo EPUB para el libro.');
                $epubPath = null;
            }
    
            $libro = new Libro();
            $libro->imagen = $imagenPath;
            $libro->archivo_pdf = $pdfPath;
            $libro->archivo_epub = $epubPath;
            $libro->titulo = $request->input('titulo');
            $libro->isbn = $request->input('isbn');
            $libro->calificacion = $request->input('calificacion');
            $libro->autor = $request->input('autor');
            $libro->coordinado_por = $request->input('coordinado_por');
            $libro->descripcion = $request->input('descripcion');
            $libro->detalle = $request->input('detalle');
            $libro->precio = $request->input('precio');
            $libro->tipo = $request->input('tipo');
            $libro->desactivar = $request->input('desactivar') !== null ? ($request->input('desactivar') ? 1 : 0) : 0;
            $libro->save();
    
            // Asignar categorías si se proporcionan
            if ($request->has('categorias')) {
                Log::info('Asignando categorías al libro con ID: ' . $libro->id);
                $libro->categorias()->attach($request->input('categorias'));
                Log::info('Categorías asignadas exitosamente.');
            } else {
                Log::info('No se proporcionaron categorías para asignar al libro.');
            }
    
            // Asignar catálogos si se proporcionan
            if ($request->has('catalogos')) {
                Log::info('Asignando catálogos al libro con ID: ' . $libro->id);
                $libro->catalogos()->attach($request->input('catalogos'));
                Log::info('Catálogos asignados exitosamente.');
            } else {
                Log::info('No se proporcionaron catálogos para asignar al libro.');
            }
    
            Log::info('Libro creado exitosamente con ID: ' . $libro->id);
            return response()->json(['message' => 'Libro creado exitosamente', 'libro' => $libro], 201);
        } catch (ValidationException $e) {
            Log::warning('Errores de validación al crear el libro: ', $e->errors());
            return response()->json(['errors' => $e->errors()], 400);
        } catch (Exception $e) {
            Log::error('Error al crear el libro: ' . $e->getMessage());
            return response()->json(['message' => 'Error al crear el libro. Intente nuevamente más tarde.'], 500);
        }
    }

    // Actualizar un libro
    public function updateBooks(Request $request, $id)
{
    try {
        $validator = Validator::make($request->all(), [
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'titulo' => 'required|string|max:255',
            'isbn' => [
                'required',
                'string',
                'max:18',
                Rule::unique('libros')->ignore($id, 'id_libro'),
            ],
            'calificacion' => 'nullable|numeric',
            'autor' => 'required|string|max:500',
            'coordinado_por' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'detalle' => 'nullable|string',
            'archivo_pdf' => 'nullable|mimes:pdf|max:10000',
            'archivo_epub' => 'nullable|mimes:epub|max:10000',
            'precio' => 'nullable|numeric',
            'tipo' => 'required|string|max:50',
            'desactivar' => 'nullable|boolean',
            'categorias' => 'nullable|array',
            'categorias.*' => 'integer|exists:categorias,id_categoria',
            'catalogos' => 'nullable|array',
            'catalogos.*' => 'integer|exists:catalogos,id_catalogo',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $libro = Libro::findOrFail($id);

        // Manejar la carga de imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('images/libros', 'public');
            $libro->imagen = $imagenPath;
        }

        // Manejar la carga de archivo PDF
        if ($request->hasFile('archivo_pdf')) {
            $pdfPath = $request->file('archivo_pdf')->store('archivos/pdf', 'public');
            $libro->archivo_pdf = $pdfPath;
        }

        // Manejar la carga de archivo EPUB
        if ($request->hasFile('archivo_epub')) {
            $epubPath = $request->file('archivo_epub')->store('archivos/epub', 'public');
            $libro->archivo_epub = $epubPath;
        }

        $libro->fill($validator->validated());
        $libro->save();

        // Asignar categorías si se proporcionan
        if ($request->has('categorias')) {
            $libro->categorias()->sync($request->input('categorias'));
        }

        // Asignar catálogos si se proporcionan
        if ($request->has('catalogos')) {
            $libro->catalogos()->sync($request->input('catalogos'));
        }

        Log::info('Libro actualizado exitosamente con ID: '.$libro->id);

        return response()->json(['message' => 'Libro actualizado exitosamente', 'libro' => $libro], 200);
    } catch (ModelNotFoundException $e) {
        Log::warning('Libro no encontrado para actualizar con ID: '.$id);
        return response()->json(['message' => 'El libro no existe'], 404);
    } catch (ValidationException $e) {
        Log::warning('Errores de validación al actualizar el libro: ', $e->errors());
        return response()->json(['errors' => $e->errors()], 400);
    } catch (Exception $e) {
        Log::error('Error al actualizar el libro: '.$e->getMessage());
        return response()->json(['message' => 'Error al actualizar el libro. Intente nuevamente más tarde.'], 500);
    }
}

    // Eliminar un libro
    public function deleteBooks($id){
        try {
            $libro = Libro::findOrFail($id);
            if ($libro) {
                // Eliminar relaciones en libros_categorias
                $libro->categorias()->detach();
                
                $libro->delete();
                
                Log::info('Libro eliminado exitosamente con ID: '.$id);

                return response()->json(['message' => 'Libro eliminado exitosamente'], 200);
            } else {
                return response()->json(['message' => 'Libro no encontrado'], 404);
            }
        } catch (ModelNotFoundException $e) {
            Log::warning('Libro no encontrado para eliminar con ID: '.$id);
            return response()->json(['message' => 'Libro no encontrado'], 404);
        } catch (Exception $e) {
            Log::error('Error al eliminar el libro: '.$e->getMessage());
            return response()->json(['message' => 'Error al eliminar el libro. Intente nuevamente más tarde.'], 500);
        }
    }

    // Desactivar un libro
    public function deactivateBooks($id, Request $request){
        try {
            $libro = Libro::findOrFail($id);
            $libro->desactivar = 1; // Establecer desactivar a 1
            $libro->save();

            Log::info('Libro desactivado exitosamente con ID: '.$libro->id);

            return response()->json(['message' => 'Libro desactivado exitosamente'], 200);
        } catch (ModelNotFoundException $e) {
            Log::warning('Libro no encontrado para desactivar con ID: '.$id);
            return response()->json(['message' => 'Libro no encontrado'], 404);
        } catch (Exception $e) {
            Log::error('Error al desactivar el libro: '.$e->getMessage());
            return response()->json(['message' => 'Error al desactivar el libro. Intente nuevamente más tarde.'], 500);
        }
    }

    // Activar un libro
    public function activateBooks($id, Request $request){
        try {
            $libro = Libro::findOrFail($id);
            $libro->desactivar = 0; // Establecer desactivar a 0
            $libro->save();

            Log::info('Libro activado exitosamente con ID: '.$libro->id);

            return response()->json(['message' => 'Libro activado exitosamente'], 200);
        } catch (ModelNotFoundException $e) {
            Log::warning('Libro no encontrado para activar con ID: '.$id);
            return response()->json(['message' => 'Libro no encontrado'], 404);
        } catch (Exception $e) {
            Log::error('Error al activar el libro: '.$e->getMessage());
            return response()->json(['message' => 'Error al activar el libro. Intente nuevamente más tarde.'], 500);
        }
    }

    //funcion para buscar un libro por titulo, autor o isbn
    public function searchBooks(Request $request){
        try {
            $search = $request->input('search');
            $libros = Libro::where('titulo', 'like', '%'.$search.'%')
                ->orWhere('autor', 'like', '%'.$search.'%')
                ->orWhere('isbn', 'like', '%'.$search.'%')
                ->get();
            return response()->json(['libros' => $libros], 200);
        } catch (Exception $e) {
            Log::error('Error al buscar los libros: '.$e->getMessage());
            return response()->json(['message' => 'Error al buscar los libros. Intente nuevamente más tarde.'], 500);
        }
    }

    //funcion para paginacion de libros
    public function paginateBooks(Request $request){
        try {
            Log::info('paginateBooks llamado');
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 8);
            $offset = ($page - 1) * $limit;
    
            $libros = Libro::where('desactivar', 0)->skip($offset)->take($limit)->get();
            $total = Libro::where('desactivar', 0)->count();
    
            Log::info('Libros paginados obtenidos exitosamente');
            return response()->json([
                'libros' => $libros,
                'total' => $total
            ]);
        } catch (Exception $e) {
            Log::error('Error al obtener los libros paginados: '.$e->getMessage());
            return response()->json(['message' => 'Error al obtener los libros paginados. Intente nuevamente más tarde.'], 500);
        }
    }
}