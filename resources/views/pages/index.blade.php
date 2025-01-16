@extends('layouts.app')
@section('title', 'Editorial | UNACH - Libros, Catálogos, Acervo Literario, Investigación')

@section('content')
    <!-- Contenido específico de la página de inicio -->
    @include('components.heroimagen')
    
    <!-- Botón de menú para dispositivos móviles -->
    <div class="lg:hidden flex justify-between items-center p-4 bg-gray-50">
        <h1 class="text-[#004A8E] text-2xl font-bold">Libros Destacados</h1>
        <button id="menu-toggle" class="text-[#003D75] focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Contenido principal -->
    
    <section class="p-6 mt-6 flex flex-col lg:flex-row gap-8">
        @include('components.sidebarComponent')
        <div class="flex-1 mt-6 lg:mt-0">
            <div class="hidden lg:block">
                <h1 class="text-[#004A8E] text-3xl font-bold">Libros Destacados</h1>
                <p class="text-gray-600 text-sm">Explora nuestra colección de libros académicos gratuitos</p>
            </div>   
            
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

    

    <!--seccion donde se va a consumir las apis y funcionalidades, usar AJAX-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            var currentPage = 1;
            var limit = 8;
            var totalBooks = 0;

            function loadBooks(page, limit) {
                $.ajax({
                    url: '/api/books/paginate',
                    method: 'GET',
                    data: {
                        page: page,
                        limit: limit
                    },
                    success: function(response){
                        console.log(response); // Para depurar y verificar la estructura de la respuesta
                        var booksHtml = '';
                        // Asumiendo que la respuesta contiene 'libros' y 'total'
                        response.libros.forEach(function(book){
                            booksHtml += `
                                <div class="border rounded-lg overflow-hidden bg-white shadow-sm">
                                    <div class="aspect-[3/4] relative bg-gray-100">
                                        <img src="/storage/${book.imagen}" alt="${book.titulo}" class="absolute inset-0 w-full h-full object-cover transition-all duration-300 hover:scale-110">
                                        <span class="absolute bottom-2 right-2 px-2 py-1 rounded text-xs ${book.tipo === 'gratuito' ? 'bg-[#F1F5F9]' : 'bg-blue-500'} ">
                                            ${book.tipo.charAt(0).toUpperCase() + book.tipo.slice(1)}
                                        </span>
                                    </div>
                                    <div class="p-4">
                                        <h2 class="font-medium text-sm mb-2 truncate">${book.titulo}</h2>
                                        <p class="text-gray-600 text-xs mb-4 truncate">${book.descripcion}</p>
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
                                        <button onclick="window.location.href='/libro/${book.id_libro}'" class="mt-2 flex w-full items-center justify-center align-content-center gap-1 text-gray-600 text-sm border rounded px-3 py-1.5 hover:bg-[#005295] hover:text-[#FFFFFF] transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
    Ver más
</button>
                                        
                                    </div>
                                </div>
                            `;
                        });
                        $('#books-container').append(booksHtml);
                        totalBooks += response.libros.length;
                        currentPage++;
                        // Ocultar el botón si ya no hay más libros
                        if(totalBooks >= response.total){
                            $('#load-more').hide();
                        }
                    },
                    error: function(){
                        console.log('Error al cargar los libros');
                    }
                });
            }

            // Cargar los primeros 8 libros
            loadBooks(currentPage, limit);

            // Evento para cargar más libros
            $('#load-more').click(function(){
                loadBooks(currentPage, limit);
            });

            // Toggle del menú en dispositivos móviles
            $('#menu-toggle').click(function(){
                $('.sidebar').toggleClass('hidden');
            });
        });
    </script>
    
@endsection
