<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Route::get('/videos', function () {
    return view('pages.videos');
})->name('videos');

Route::get('/deseos', function () {
    return view('pages.deseos');
})->name('deseos');

Route::get('/comparador', function () {
    return view('pages.comparador');
})->name('comparador');

Route::get('/login', function () {
    return view('pages.login');
})->name('loginpage');

Route::post('/login', [LoginController::class, 'loginUser'])->name('login');
Route::post('/logout', [LoginController::class, 'logoutUser'])->name('logout');

Route::get('/registro', function () {
    return view('pages.singup');
})->name('registro');

Route::get('/carrito', function () {
    return view('pages.carrito');
})->name('carrito');

//pagina de catalogos
Route::get('/lee-unach', function () {
    return view('pages.catalogos.leeunach');
})->name('leeunach');

Route::get('/cuadernos-universitarios', function () {
    return view('pages.catalogos.cuadernosU');
})->name('cuadernosU');

Route::get('/textos-unach', function () {
    return view('pages.catalogos.textosunach');
})->name('textosunach');

Route::get('/letras-sin-papel', function () {
    return view('pages.catalogos.letras');
})->name('letrasinpapel');

Route::get('/eventos', function () {
    return view('pages.catalogos.eventos');
})->name('eventospage');

Route::get('/libro/{id}', [App\Http\Controllers\Books\BooksUtility::class, 'show'])->name('detallesBook.show');



//paginas del dashboard
//grupo de rutas protegidas por el middleware AdminMiddleware donde alias es admin

Route::middleware('admin')->group(function () {
    Route::get('/dashboard-admin', function () {
        return view('dashboard.home');
    })->name('dashboard');

    //ruta de libro del dashboard
    Route::get('/dashboard-admin/libro', function () {
        return view('dashboard.libro');
    })->name('libro');

    //ruta de categorias del dashboard
    Route::get('/dashboard-admin/categorias', function () {
        return view('dashboard.categorias');
    })->name('categorias');

    //ruta de usuarios del dashboard
    Route::get('/dashboard-admin/usuarios', function () {
        return view('dashboard.usuarios');
    })->name('usuarios');

    //ruta de videos del dashboard
    Route::get('/dashboard-admin/videos', function () {
        return view('dashboard.videos');
    })->name('videosDashboard');

    //ruta de comentarios del dashboard
    Route::get('/dashboard-admin/comentarios', function () {
        return view('dashboard.comentarios');
    })->name('comentarios');

    //ruta de reportes del dashboard
    Route::get('/dashboard-admin/reportes', function () {
        return view('dashboard.reportes');
    })->name('reportes');

    //ruta de configuracion del dashboard
    Route::get('/dashboard-admin/configuracion', function () {
        return view('dashboard.configuracion');
    })->name('configuracion');
    
});