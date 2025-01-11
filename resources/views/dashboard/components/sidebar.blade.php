@php
    $menuItems = [
        ['route' => 'dashboard', 'icon' => 'layout-dashboard', 'name' => 'Inicio'],
        ['route' => 'libro', 'icon' => 'book-open', 'name' => 'Libros'],
        ['route' => 'categorias', 'icon' => 'list-tree', 'name' => 'Categorias'],
        ['route' => 'usuarios', 'icon' => 'users', 'name' => 'Usuarios'],
        ['route' => 'videosDashboard', 'icon' => 'video', 'name' => 'Videos'],
        ['route' => 'comentarios', 'icon' => 'message-square-more', 'name' => 'Comentarios'],
        ['route' => 'reportes', 'icon' => 'file-chart-column-increasing', 'name' => 'Reportes'],
        ['route' => 'configuracion', 'icon' => 'bolt', 'name' => 'Configuracion'],
    ];
@endphp

<div class="sidebar fixed top-0 left-0 h-full w-64 bg-white border-r border-[#DFE5EF]">
    <div class="logo flex h-20 items-center justify-center px-6">
        <img src="{{ asset('img/logo_siresu_dashboard.svg') }}" alt="Logo" class="w-32">
    </div>

    <nav class="flex-1 py-6 px-4">
        <div class="w-full h-8 px-3 items-center flex">
            <h6 class="text-[#09224B] text-xs font-semibold leading-4">MENU</h6>
        </div>
        <ul class="space-y-2">
            @foreach ($menuItems as $item)
                <li class="{{ request()->routeIs($item['route']) ? 'bg-[#09224B]' : '' }} rounded-lg">
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-2 px-4 py-2 transition-colors {{ request()->routeIs($item['route']) ? 'text-[#FFFFFF]' : 'text-[#2A3547]' }} hover:bg-[#005295] hover:text-[#FFFFFF] rounded-lg">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5"></i>
                        <span class="text-sm">{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
