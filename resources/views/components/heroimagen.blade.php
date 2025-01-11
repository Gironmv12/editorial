<div class="relative min-h-[600px] w-full">

    @if(session('message'))
        <div class="fixed top-0 left-0 right-0 bg-green-500 text-white text-center py-2">
            {{ session('message', 'nombre_usuario') }} 

        </div>
    @endif

    <!-- Imagen de Fondo -->
    <div 
        class="absolute inset-0 z-0"
        style="background-image: url('{{ asset('img/acerca-de.jpg') }}'); 
               background-size: cover; 
               background-position: center;">
        <!-- Overlay para oscuridad -->
        <div class="absolute inset-0 bg-black opacity-60"></div>
    </div>
    
    <!-- Contenedor de Contenido -->
    <div class="relative flex flex-col items-center justify-center min-h-[600px] px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-[#B2F0FF] to-[#009CFF] bg-clip-text text-transparent mb-6">
            Biblioteca Digital UNACH
        </h1>
        <p class="text-xl md:text-2xl text-white max-w-3xl">
            Explora nuestra colección de libros académicos y recursos digitales
        </p>
    </div>
</div>