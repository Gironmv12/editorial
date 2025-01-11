<nav class="navbar bg-white h-16 flex items-center justify-between px-4">
    <!-- Links principales -->
    <ul class="navbar-nav flex space-x-4">
        <li class="nav-item">
            <a class="nav-link text-gray-700 hover:text-[#005295] flex items-center gap-2" href="{{ route('libro') }}">
                <i data-lucide="library" class="h-5 w-5"></i>
                <span>Libros</span> 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-gray-700 hover:text-[#005295] flex items-center gap-2" href="{{ route('usuarios') }}">
                <i data-lucide="users" class="h-5 w-5"></i>
                <span>Usuarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-gray-700 hover:text-[#005295] flex items-center gap-2" href="{{ route('reportes') }}">
                <i data-lucide="file-chart-column-increasing" class="h-5 w-5"></i>
                <span>Reportes</span> 
            </a>
        </li>
    </ul>
    <!-- Usuario dropdown -->
    <div class="relative">
        @if(session('nombre_usuario'))
            <button
                id="userDropdownButton"
                class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100 transition-colors"
            >
                <div class="flex items-center justify-center">
                    <div class="relative flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-100">
                        <i data-lucide="user" class="h-5 w-5"></i>
                    </div>
                    <span class="ml-2 text-gray-700">{{ session('nombre_usuario') }}</span>
                    <svg class="ml-2 h-4 w-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </button>

            <!-- Dropdown -->
            <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-56 rounded-md border border-gray-200 bg-white py-1 shadow-lg">
                <div class="px-4 py-2">
                    <p class="text-sm font-medium text-gray-700">{{ session('nombre_usuario') }}</p>
                    <p class="text-xs text-gray-500">{{ session('rol') }}</p>
                </div>
                <div class="border-t border-gray-200"></div>
                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm flex items-center gap-2" href="{{ route('index') }}">
                    <i data-lucide="house" class="h-4 w-4"></i> 
                    <span>Página principal</span>                
                </a>
                <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2">
                        <i data-lucide="log-out" class="h-4 w-4"></i>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        @endif
    </div>
</nav>

<script>
    // Script para manejar el toggle del dropdown
    document.getElementById('userDropdownButton').addEventListener('click', function () {
        const menu = document.getElementById('userDropdownMenu');
        menu.classList.toggle('hidden');
    });

    // Cierra el dropdown si se hace clic fuera de él
    window.addEventListener('click', function (e) {
        const button = document.getElementById('userDropdownButton');
        const menu = document.getElementById('userDropdownMenu');
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
