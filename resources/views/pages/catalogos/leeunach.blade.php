@extends('layouts.app')
@section('title', 'Home | Catalogos - Lee UNACH')

@section('content')
    <!-- Contenido específico de la página de Lee UNACH -->
    @include('components.heroimagen')

    <section class="p-6 mt-6 flex flex-col lg:flex-row gap-8">
        @include('components.sidebarComponent')
        <div class="flex-1 mt-6 lg:mt-0">
            <div class="hidden lg:block">
                <h1 class="text-[#004A8E] text-3xl font-bold">Libros Destacados</h1>
                <p class="text-gray-600 text-sm">Explora nuestra colección de libros académicos gratuitos</p>
            </div>

            <nav class="flex mt-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="/" class="text-gray-700 hover:text-blue-600">Inicio</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mx-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-500">LEE UNACH</span>
                        </div>
                    </li>
                </ol>
            </nav>
               
            
            <!--LIBROS DESTACADOS-->
            <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
                <!-- Las tarjetas de libros se cargarán aquí -->
            </div>
            
            <!-- Botón para cargar más libros -->
            <div class="flex justify-center mt-6">
                <button id="load-more" class="bg-[#003D75] text-white px-4 py-2 rounded hover:bg-[#005295]">Ver más libros</button>
            </div>
            
        </div>
    </section>
@endsection