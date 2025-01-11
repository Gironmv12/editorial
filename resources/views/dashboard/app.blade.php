<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Francisco Giron">
    <link rel="icon" href="{{ asset('public/logo_siresu_dashboard.svg') }}" type="image/svg+xml">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex">
    <!-- Componente del sidebar -->
    @include('dashboard.components.sidebar')
    <!-- Main Container -->
    <div class="flex flex-col flex-1 ml-64 bg-[#F8FAFD]">
        <!-- Navbar -->
        @include('dashboard.components.nav')
        <!-- Main Content -->
        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();
    });
</script>
</body>
</html>