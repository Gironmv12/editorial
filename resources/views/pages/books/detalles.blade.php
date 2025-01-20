{{-- filepath: /c:/Users/Giron/editorial-unach/resources/views/pages/books/detalles.blade.php --}}
@extends('layouts.app')

@section('title', 'Detalles del Libro')

@section('content')
<div class="p-6 mt-6 flex flex-col lg:flex-row gap-8">
    @include('components.sidebarComponent')
    <div class="p-4">
        <div class="grid gap-8 md:grid-cols-[300px_1fr]">
            {{-- Imagen del Libro --}}
            <div class="space-y-4">
                <div class="overflow-hidden rounded-lg border border-gray-200 bg-gray-100">
                    <img
                        src="{{ $libro->imagen ? asset('storage/' . $libro->imagen) : '/placeholder.svg' }}"
                        alt="{{ htmlspecialchars($libro->titulo) }}"
                        width="600"
                        height="800"
                        class="aspect-[3/4] h-auto w-full object-cover"
                    />
                </div>
                {{-- Botones de Descarga --}}
                <div class="space-y-2">

                    <a
                    href="{{ asset($libro->archivo_pdf) }}"
                    target="_blank"
                    class="flex w-full items-center justify-center rounded-md bg-[#003D75] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 active:bg-gray-800"
                >
                    <svg
                        class="mr-2 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M7 7h10v10M7 17l10-10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Ver Archivo Digital(pdf)
                </a>


                        <a
                            href="{{ $libro->archivo_epub }}"
                            download
                            class="flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 active:bg-gray-100"
                        >
                            <svg
                                class="mr-2 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M4 16l8 8 8-8M12 24V4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Descargar EPUB
                        </a>
                </div>
            </div>

            {{-- Información del Libro --}}
            <div class="space-y-6">
                {{-- Categorías y Tipo --}}
                <div class="space-y-2">
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center rounded-full border border-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-700 capitalize">
                            {{ htmlspecialchars($libro->tipo) }}
                        </span>

                            {{-- Iterar sobre categorías --}}
                        @foreach($libro->categorias as $categoria)
                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                            {{ htmlspecialchars($categoria->nombre_categoria) }}
                        </span>
                    @endforeach

                    {{-- Iterar sobre catálogos --}}
                    @foreach($libro->catalogos as $catalogo)
                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                            {{ htmlspecialchars($catalogo->nombre_catalogo) }}
                        </span>
                    @endforeach
                    </div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ htmlspecialchars($libro->titulo) }}</h1>
                </div>

                {{-- Calificación --}}

                    <div class="flex items-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg
                                class="h-5 w-5 {{ $i < floor($libro->calificacion) ? 'fill-yellow-400 text-yellow-400' : 'fill-gray-200 text-gray-200' }}"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm text-gray-600">
                            {{ htmlspecialchars($libro->calificacion) }} de 5
                        </span>
                    </div>

                {{-- Detalles Adicionales --}}
                <div class="space-y-4">
                    <div class="grid gap-2">
                        <div class="text-sm text-gray-600">Autor</div>
                        <div class="font-medium text-gray-900">{{ htmlspecialchars($libro->autor) }}</div>
                    </div>
                    <div class="grid gap-2">
                        <div class="text-sm text-gray-600">Coordinado por</div>
                        <div class="font-medium text-gray-900">{{ htmlspecialchars($libro->coordinado_por) }}</div>
                    </div>
                    <div class="grid gap-2">
                        <div class="text-sm text-gray-600">ISBN</div>
                        <div class="font-medium text-gray-900">{{ htmlspecialchars($libro->isbn) }}</div>
                    </div>
                </div>

                <hr class="border-gray-200" />

                {{-- Descripción --}}
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-900">Descripción</h2>
                    <p class="text-gray-600 text-justify text-sm">{{ htmlspecialchars($libro->descripcion) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection