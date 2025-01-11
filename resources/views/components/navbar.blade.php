<nav class="bg-[#00294F] px-4 py-3 relative z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-white text-2xl font-bold">
            <img src="{{ asset('img/logo_siresu.svg') }}" alt="Logo" class="w-32">
        </a>

        <!-- Botón del menú para móviles -->
        <button 
            type="button" 
            class="text-white md:hidden flex items-center p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200"
            id="menuButton"
            aria-controls="menu"
            aria-expanded="false"
        >
            <span class="sr-only">Abrir menú principal</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#ffffff" d="M7 12a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0m7 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/></svg>
        </button>

        <!-- Navigation Items -->
        <div class="hidden md:flex md:items-center md:space-x-6 w-full md:w-auto flex-col md:flex-row absolute md:relative top-full left-0 md:top-auto md:left-auto bg-[#00294F] md:bg-transparent p-4 md:p-0 space-y-4 md:space-y-0" id="menu">
            <a 
                href="{{ asset('doc/NORMAS_Y_CRITERIOS_EDITORIAL_UNACH.pdf') }}" 
                class="text-white hover:text-gray-300 flex items-center gap-2 text-sm"
                target="_blank"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open"><path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/></svg>
                <span>Lineamientos editoriales</span>
            </a>

            <a 
                href="{{ route('videos') }}" 
                class="text-white hover:text-gray-300 flex items-center gap-2 text-sm"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video"><path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/><rect x="2" y="6" width="14" height="12" rx="2"/></svg>
                <span>Videos</span>
            </a>

            <a 
                href="{{ route('deseos') }}" 
                class="text-white hover:text-gray-300 flex items-center gap-2 text-sm"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                
                <span>Deseos</span>
            </a>

            <a 
                href="{{ route('comparador') }}" 
                class="text-white hover:text-gray-300 flex items-center gap-2 text-sm"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-right"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>
                <span>Comparador</span>
            </a>

            <!-- Opción exclusiva para administradores -->
            @if(session('rol') === 'admin')
                <a 
                    href="{{ route('dashboard') }}" 
                    class="text-white hover:text-gray-300 flex items-center gap-2 text-sm"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <path d="M3 9h18"></path>
                        <path d="M9 3v18"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
            @endif

            <div class="flex items-center gap-4 ml-4 pl-4 border-l border-gray-600">
                @if(session('nombre_usuario'))
                    <div class="relative">
                        <button id="userButton" class="text-white flex items-center gap-2 text-sm">
                            {{ session('nombre_usuario') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="dropdownMenu" class="absolute right-0 mt-2 w-44 bg-white text-black rounded-md shadow-lg hidden">
                            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2">
                                    <i data-lucide="log-out" class="h-4 w-4"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a 
                        href="{{ route('login') }}" 
                        class="text-white hover:text-gray-300 flex items-center gap-2 text-sm"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg>
                        <span>Acceso</span>
                    </a>
                @endif
                <a 
                    href="{{ route('carrito') }}" 
                    class="text-white hover:text-gray-300"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>                
            </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userButton = document.getElementById('userButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const menuButton = document.getElementById('menuButton');

        if (userButton) {
            userButton.addEventListener('click', function(event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
        }

        if (dropdownMenu) {
            dropdownMenu.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        }

        if (menuButton) {
            menuButton.addEventListener('click', function() {
                const menu = document.getElementById('menu');
                menu.classList.toggle('hidden');
                menu.classList.toggle('flex');
            });
        }

        window.addEventListener('click', function(event) {
            if (userButton && dropdownMenu) {
                if (!userButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            }
        });
    });
</script>

