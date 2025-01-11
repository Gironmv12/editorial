<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Libros editados por la Universidad Autónoma de Chiapas, de investigación, culturales y literarios. Difundir lo más relevante del conocimiento.">
    <meta name="keywords" content="Editorial, Libros, Libreria, UNACH, Conocimiento, Libro, Acervo literario,Catalogo">
    <meta name="author" content="Francisco Giron">
    <!--Icon-->
    <link rel="icon" href="{{ asset('images/logo_siresu_dashboard.svg') }}" type="image/svg+xml">
    <title>@yield('title', 'Editorial | UNACH - Libros, Catálogos, Acervo Literario, Investigación')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!--Incluir los iconos de lucide icpns CDN-->
    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!--Navbar importado de resources\views\components\navbar.blade.php -->
    @include('components.navbar')

    @yield('content')

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>

