@extends('layouts.app')
@section('title', 'Home | Deseos')

@section('content')
@include('components.heroimagen')

<section class="p-6 mt-6 flex flex-col lg:flex-row gap-8">
    @include('components.sidebarComponent')
    <div class="flex-1 mt-6 lg:mt-0">
        <div class="hidden lg:block">
            <h1 class="text-[#004A8E] text-3xl font-bold">Mis Deseos</h1>
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
                        <span class="text-gray-500">Mis Deseos</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!--LIBROS Guardados(DESEOS)-->
        <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
            <!-- Las tarjetas de libros se cargarán aquí -->
        </div>
        
    </div>
</section>

<!--seccion donde se va a consumir las apis y funcionalidades, usar AJAX-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Obtener el ID del usuario logueado
        var userId = {{ session('id_usuario') }};

        // Realizar la solicitud AJAX al endpoint
        $.ajax({
            url: '/api/deseos/' + userId,
            method: 'GET',
            success: function(data) {
                var booksContainer = $('#books-container');
                booksContainer.empty(); // Limpiar contenedor

                if(data.length === 0){
                    booksContainer.append('<p>No tienes libros en tu lista de deseos.</p>');
                    return;
                }

                // Iterar sobre los libros y generar las tarjetas
                data.forEach(function(deseo) {
                    var libro = deseo.libro;
                    var card = `
                        <div class="border rounded-lg overflow-hidden bg-white shadow-sm">
                                    <div class="aspect-[3/4] relative bg-gray-100">
                                        <img src="/storage/${libro.imagen}" alt="${libro.titulo}" class="absolute inset-0 w-full h-full object-cover transition-all duration-300 hover:scale-110">
                                        <span class="absolute bottom-2 right-2 px-2 py-1 rounded text-xs ${libro.tipo === 'gratuito' ? 'bg-[#F1F5F9]' : 'bg-blue-500'} ">
                                            ${libro.tipo.charAt(0).toUpperCase() + libro.tipo.slice(1)}
                                        </span>
                                    </div>
                                    <div class="p-4">
                                        <h2 class="font-medium text-sm mb-2 truncate">${libro.titulo}</h2>
                                        <p class="text-gray-600 text-xs mb-4 truncate">${libro.descripcion}</p>
                                        <div class="flex items-center justify-between gap-2">
                                            <button class="flex items-center gap-1 text-gray-600 text-sm border rounded px-3 py-1.5 hover:bg-gray-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart">
                                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                                                </svg>
                                                Guardar
                                            </button>
                                            <button class="flex items-center gap-1 text-gray-600 text-sm border rounded px-3 py-1.5 hover:bg-gray-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-right">
                                                    <path d="M8 3 4 7l4 4"/>
                                                    <path d="M4 7h16"/>
                                                    <path d="m16 21 4-4-4-4"/>
                                                    <path d="M20 17H4"/>
                                                </svg>
                                                Comparar
                                            </button>
                                        </div>
                                        <button onclick="window.location.href='/libro/${libro.id_libro}'" class="mt-2 flex w-full items-center justify-center align-content-center gap-1 text-gray-600 text-sm border rounded px-3 py-1.5 hover:bg-[#005295] hover:text-[#FFFFFF] transition-colors">
                                            
    Ver detalles
</button>
                                        
                                    </div>
                                </div>
                    `;
                    booksContainer.append(card);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los deseos:', error);
                $('#books-container').html('<p>Error al cargar tus deseos. Por favor, intenta de nuevo más tarde.</p>');
            }
        });
    });
</script>

@endsection