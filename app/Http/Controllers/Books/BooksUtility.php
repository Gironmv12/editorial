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
    
}