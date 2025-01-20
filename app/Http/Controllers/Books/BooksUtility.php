<?php
namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Catalogo;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;



class BooksUtility extends Controller{
    //mostrar detalles de un libro por id

    public function show($id){
        try{
            $libro = Libro::with(['categorias', 'catalogos'])->findOrFail($id);
            return view('pages.books.detalles', compact('libro'));
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }catch(Exception $e){
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }
    
    //Función para obtener los libros del catálogo "LEE UNACH"
    public function getLibrosDisponibles()
    {
        try {
            Log::info("Iniciando la obtención de libros disponibles en el catálogo 'LEE UNACH'.");

            // Obtener libros que no están desactivados y que están asociados con el catálogo 'LEE UNACH'
            $catalogo = Catalogo::where('nombre_catalogo', 'LEE UNACH')->first();
            
            if (!$catalogo) {
                Log::warning("El catálogo 'LEE UNACH' no existe.");
                return response()->json(['message' => "El catálogo 'LEE UNACH' no existe."], 404);
            }
            
            $libros = Libro::where('desactivar', 0)
                ->whereHas('catalogos', function ($query) use ($catalogo) {
                    $query->where('catalogos.id_catalogo', $catalogo->id_catalogo);
                })
                ->get();

            Log::info("Cantidad de libros obtenidos: " . $libros->count());

            // Si no se encuentran libros
            if ($libros->isEmpty()) {
                Log::warning("No se encontraron libros en el catálogo 'LEE UNACH'.");
            }

            return response()->json($libros, 200);

        } catch (Exception $e) {
            // Captura errores y muestra mensaje en log
            Log::error("Error al obtener libros del catálogo 'LEE UNACH': " . $e->getMessage());
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    //funcion para obtener los libros del catalogo "CUADERNOS UNIVERSITARIOS"
    public function getBooksCatalogoCuadernos(){
        try{
            Log::info("Iniciando la obtención de libros disponibles en el catálogo 'CUADERNOS UNIVERSITARIOS'.");

            // Obtener libros que no están desactivados y que están asociados con el catálogo 'CUADERNOS UNIVERSITARIOS'
            $catalogo = Catalogo::where('nombre_catalogo', 'CUADERNOS UNIVERSITARIOS')->first();
            
            if (!$catalogo) {
                Log::warning("El catálogo 'CUADERNOS UNIVERSITARIOS' no existe.");
                return response()->json(['message' => "El catálogo 'CUADERNOS UNIVERSITARIOS' no existe."], 404);
            }
            
            $libros = Libro::where('desactivar', 0)
                ->whereHas('catalogos', function ($query) use ($catalogo) {
                    $query->where('catalogos.id_catalogo', $catalogo->id_catalogo);
                })
                ->get();

            Log::info("Cantidad de libros obtenidos: " . $libros->count());

            // Si no se encuentran libros
            if ($libros->isEmpty()) {
                Log::warning("No se encontraron libros en el catálogo 'CUADERNOS UNIVERSITARIOS'.");
            }

            return response()->json($libros, 200);

        } catch (Exception $e) {
            // Captura errores y muestra mensaje en log
            Log::error("Error al obtener libros del catálogo 'CUADERNOS UNIVERSITARIOS': " . $e->getMessage());
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    //funcion para obtener los libros del catalogo "TEXTOS UNACH"
    public function getBooksCatalogoTextos(){
        try{
            Log::info("Iniciando la obtención de libros disponibles en el catálogo 'TEXTOS UNACH'.");

            // Obtener libros que no están desactivados y que están asociados con el catálogo 'TEXTOS UNACH'
            $catalogo = Catalogo::where('nombre_catalogo', 'TEXTOS UNACH')->first();
            
            if (!$catalogo) {
                Log::warning("El catálogo 'TEXTOS UNACH' no existe.");
                return response()->json(['message' => "El catálogo 'TEXTOS UNACH' no existe."], 404);
            }
            
            $libros = Libro::where('desactivar', 0)
                ->whereHas('catalogos', function ($query) use ($catalogo) {
                    $query->where('catalogos.id_catalogo', $catalogo->id_catalogo);
                })
                ->get();

            Log::info("Cantidad de libros obtenidos: " . $libros->count());

            // Si no se encuentran libros
            if ($libros->isEmpty()) {
                Log::warning("No se encontraron libros en el catálogo 'TEXTOS UNACH'.");
            }

            return response()->json($libros, 200);

        } catch (Exception $e) {
            // Captura errores y muestra mensaje en log
            Log::error("Error al obtener libros del catálogo 'TEXTOS UNACH': " . $e->getMessage());
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    //funcion para obtener los libros del catalogo "LETRAS SIN PAPEL"
    public function getBooksCatalogoLetras(){
        try{
            Log::info("Iniciando la obtención de libros disponibles en el catálogo 'LETRAS SIN PAPEL'.");

            // Obtener libros que no están desactivados y que están asociados con el catálogo 'LETRAS SIN PAPEL'
            $catalogo = Catalogo::where('nombre_catalogo', 'LETRAS SIN PAPEL')->first();
            
            if (!$catalogo) {
                Log::warning("El catálogo 'LETRAS SIN PAPEL' no existe.");
                return response()->json(['message' => "El catálogo 'LETRAS SIN PAPEL' no existe."], 404);
            }
            
            $libros = Libro::where('desactivar', 0)
                ->whereHas('catalogos', function ($query) use ($catalogo) {
                    $query->where('catalogos.id_catalogo', $catalogo->id_catalogo);
                })
                ->get();

            Log::info("Cantidad de libros obtenidos: " . $libros->count());

            // Si no se encuentran libros
            if ($libros->isEmpty()) {
                Log::warning("No se encontraron libros en el catálogo 'LETRAS SIN PAPEL'.");
            }

            return response()->json($libros, 200);

        } catch (Exception $e) {
            // Captura errores y muestra mensaje en log
            Log::error("Error al obtener libros del catálogo 'LETRAS SIN PAPEL': " . $e->getMessage());
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    //funcion para obtener los libros del catalogo "EVENTOS"
    public function getBooksCatalogoEventos(){
        try{
            Log::info("Iniciando la obtención de libros disponibles en el catálogo 'EVENTOS'.");

            // Obtener libros que no están desactivados y que están asociados con el catálogo 'EVENTOS'
            $catalogo = Catalogo::where('nombre_catalogo', 'EVENTOS')->first();
            
            if (!$catalogo) {
                Log::warning("El catálogo 'EVENTOS' no existe.");
                return response()->json(['message' => "El catálogo 'EVENTOS' no existe."], 404);
            }
            
            $libros = Libro::where('desactivar', 0)
                ->whereHas('catalogos', function ($query) use ($catalogo) {
                    $query->where('catalogos.id_catalogo', $catalogo->id_catalogo);
                })
                ->get();

            Log::info("Cantidad de libros obtenidos: " . $libros->count());

            // Si no se encuentran libros
            if ($libros->isEmpty()) {
                Log::warning("No se encontraron libros en el catálogo 'EVENTOS'.");
            }

            return response()->json($libros, 200);

        } catch (Exception $e) {
            // Captura errores y muestra mensaje en log
            Log::error("Error al obtener libros del catálogo 'EVENTOS': " . $e->getMessage());
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }
}