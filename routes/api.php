<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Books\BooksController;
use App\Http\Controllers\Categorias\CategoriasController;
use App\Http\Controllers\Catalogos\CatalogosController;
//test de prueba
Route::get('/test', function(){
    return response()->json(['message' => 'Hello World!'], 200);
});

//ruta para registrar un usuario
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register');
//ruta para loguear el usuario
Route::post('/login', [LoginController::class, 'loginUser'])->name('login');
Route::post('/logout', [LoginController::class, 'logoutUser'])->name('logout');

//RUTAS DE USERS
Route::prefix('users')->group(function () {
    //ruta para obtener usuarios        
    Route::get('/', [UserController::class, 'GetUsers']);
    //ruta para obtener un usuario por id
    Route::get('/{id}', [UserController::class, 'GetUser']);
    //ruta para crear un usuario    
    Route::post('/', [UserController::class, 'CreateUser']);
    //ruta para actualizar un usuario  
    Route::put('/{id}', [UserController::class, 'UpdateUser']);
    //ruta para eliminar un usuario
    Route::delete('/{id}', [UserController::class, 'DeleteUser']);
});

//RUTA DE LIBROS
//ruta para crear un libro
Route::prefix('books')->group(function () {
    // Ruta para obtener libros por paginación
    Route::get('/paginate', [BooksController::class, 'paginateBooks']);
    //ruta para crear un libro
    Route::post('/', [BooksController::class, 'CreateBooks']);
    //ruta para obtener todos los libros
    Route::get('/', [BooksController::class, 'GetBooks']);
    //ruta para obtener un libro por id
    Route::get('/{id}', [BooksController::class, 'GetBook']);
    //ruta para actualizar un libro
    Route::put('/{id}', [BooksController::class, 'updateBooks']);
    //ruta para eliminar un libro   
    Route::delete('/{id}', [BooksController::class, 'deleteBooks']);
    //ruta para desactivar un libro
    Route::put('/desactivate/{id}', [BooksController::class, 'deactivateBooks']);
    //ruta para activar un libro
    Route::put('/activate/{id}', [BooksController::class, 'activateBooks']);
    //ruta para buscar un libro por titulo, autor o isbn
    Route::post('/search', [BooksController::class, 'searchBooks']);
});


//RUTA DE CATEGORIAS
Route::prefix('categorias')->group(function () {
    //ruta para obtener todas las categorias
    Route::get('/', [CategoriasController::class, 'getCategorias']);
    //ruta para crear una categoria
    Route::post('/', [CategoriasController::class, 'createCategorias']);
    //ruta para obtener una categoria por id
    Route::get('/{id}', [CategoriasController::class, 'getCategoria']);
    //ruta para actualizar una categoria
    Route::put('/{id}', [CategoriasController::class, 'updateCategoria']);
    //ruta para eliminar una categoria
    Route::delete('/{id}', [CategoriasController::class, 'deleteCategoria']);
});

//RUTA PARA CATALOGOS  
//ruta para obtener todos los catalogos
Route::prefix('catalogos')->group(function () {
    //ruta para obtener todos los catalogos
    Route::get('/', [CatalogosController::class, 'getCatalogos']);
    //ruta para crear un catalogo
    Route::post('/', [CatalogosController::class, 'createCatalogo']);  
    //ruta para obtener un catalogo por id
    Route::get('/{id}', [CatalogosController::class, 'getCatalogo']);
    //ruta para actualizar un catalogo
    Route::put('/{id}', [CatalogosController::class, 'updateCatalogo']);
    //ruta para eliminar un catalogo
    Route::delete('/{id}', [CatalogosController::class, 'deleteCatalogo']);
});