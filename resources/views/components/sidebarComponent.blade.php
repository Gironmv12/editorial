<div class="sidebar w-full max-w-xs min-h-screen p-4 lg:block hidden">
    <!-- Search Bar -->
    <div class="relative mb-4">
        <input 
            type="search" 
            placeholder="Buscar un libro" 
            class="w-full p-2 pl-4 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#003D75] text-white px-4 py-1 rounded-md">
            Buscar
        </button>
    </div>

    <!-- Currency Selector -->
    <button class="w-full flex items-center justify-between p-3 mb-6 border border-gray-200 rounded-lg">
        <span class="text-gray-700">Pesos mexicanos</span>
        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Categories Section -->
    <div class="space-y-4">
        <h2 class="font-semibold text-[#003D75] mb-4">Catalogo</h2>
        
        <nav class="space-y-2">
            @php
                $categories = [
                    ['route' => 'leeunach', 'label' => 'LEE UNACH', 'icon' => 'book'],
                    ['route' => 'cuadernosU', 'label' => 'CUADERNOS UNIVERSITARIOS', 'icon' => 'graduation-cap'],
                    ['route' => 'textosunach', 'label' => 'TEXTOS UNACH', 'icon' => 'book-text'],
                    ['route' => 'letrasinpapel', 'label' => 'LETRAS SIN PAPEL', 'icon' => 'book-open'],
                    ['route' => 'eventospage', 'label' => 'EVENTOS', 'icon' => 'calendar-days']
                ];
            @endphp

            @foreach ($categories as $category)
                <a href="{{ route($category['route']) }}" class="{{ Route::currentRouteName() == $category['route'] ? 'bg-[#1e3a8a] text-[#FFFFFF]' : 'text-[#2A3547]' }} flex items-center gap-3 p-2 hover:bg-[#005295] hover:text-[#FFFFFF] rounded-lg transition-colors">
                    <i data-lucide="{{ $category['icon'] }}" class="w-5"></i>
                    <span class="text-sm">{{ $category['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
</div>
