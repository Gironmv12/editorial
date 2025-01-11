@extends('dashboard.app')
@section('title', 'Libros')


@section('content')
    <!-- Contenido específico de la página de libro dashboard -->
    <div class="container">
        <div class="w-full p-6 bg-[#EBF3FE] rounded-lg mb-6">
            <h2 class="text-xl font-semibold mb-4 text-[#005295]">Crear un libro</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-[#005295]">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            Inicio
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-gray-400 md:ms-2">Libros</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mb-6">
            <ul class="flex border-b border-gray-200" id="tabs">
                <li>
                    <button class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 inline-flex items-center gap-2 active" data-tab="add-book">
                        <!-- Icono para "Agregar libro" -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Agregar libro
                    </button>
                </li>
                <li>
                    <button class="px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 inline-flex items-center gap-2" data-tab="view-books">
                        <!-- Icono para "Ver libros" -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4h18M3 9h18M3 14h18M3 19h18"/>
                        </svg>
                        Ver libros
                    </button>
                </li>
            </ul>
        </div>
        
        <!--Formulario para agregar un libro-->
        <div id="tab-add-book" class="tab-content">
            <form id="formLibro" enctype="multipart/form-data" >
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-md font-semibold text-gray-900 mb-4">Informacion Basica</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <!-- Título -->
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título:</label>
                            <input type="text" id="titulo" name="titulo" required maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el título">
                        </div>
    
                        <div>
                            <!-- ISBN -->
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN:</label>
                            <input type="text" id="isbn" name="isbn" required maxlength="18" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el ISBN">
                        </div>
    
                        <div>
                            <!-- Calificación -->
                            <label for="calificacion" class="block text-sm font-medium text-gray-700 mb-1">Calificación:</label>
                            <input type="number" step="0.01" id="calificacion" name="calificacion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa la calificación">
                        </div>
    
                        <div>
                            <!-- Autor -->
                            <label for="autor" class="block text-sm font-medium text-gray-700 mb-1">Autor:</label>
                            <input type="text" id="autor" name="autor" required maxlength="500" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el autor">
                        </div>
    
                        <div>
                            <!-- Coordinado por -->
                            <label for="coordinado_por" class="block text-sm font-medium text-gray-700 mb-1">Coordinado por:</label>
                            <input type="text" id="coordinado_por" name="coordinado_por" maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el coordinador">
                        </div>
                    </div>
                </section>
    
                <!-- Detalles y precios -->
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-medium text-[#09224B] mb-4">Detalle y precio</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <!-- Descripción -->
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Descripcion del libro"></textarea>
                        </div>
    
                        <div>
                            <!-- Detalle -->
                            <label for="detalle" class="block text-sm font-medium text-gray-700 mb-1">Detalle:</label>
                            <textarea id="detalle" name="detalle" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Detalles del libro"></textarea>
                        </div>
    
                        <div>
                            <!-- Precio -->
                            <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio:</label>
                            <input type="number" step="0.01" id="precio" name="precio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
    
                        <div>
                            <!-- Tipo -->
                            <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo:</label>
                            <select id="tipo" name="tipo" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="gratuito">Gratuito</option>
                                <option value="de_pago">De Pago</option>
                            </select>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-medium text-[#09224B] mb-4">Categorías</h2>
                    <div>
                        <label for="categorias" class="block text-sm font-medium text-gray-700 mb-1">Selecciona las categorías:</label>
                        <select id="categorias" name="categorias[]" multiple required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <!-- Reemplaza con opciones dinámicas -->
                        </select>
                    </div>
                </section>
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-medium text-[#09224B] mb-4">Catálogos</h2>
                    <div>
                        <label for="catalogos" class="block text-sm font-medium text-gray-700 mb-1">Selecciona los catálogos:</label>
                        <select id="catalogos" name="catalogos[]" multiple required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <!-- Reemplaza con opciones dinámicas -->
                        </select>
                    </div>
                </section>
    
                <!-- Subida de documentos -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                        <h2 class="text-lg font-medium text-[#020617] mb-2">Imagen</h2>
                        <p class="text-xs text-gray-500 mb-2">Seleccione una imagen para el libro.</p>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-[#F1F5F9] shadow-sm">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg" class="mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 text-center mt-2">Examine para seleccionar</p>
                        </div>
                    </section>
    
                    <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                        <h2 class="text-lg font-medium text-[#020617] mb-2">Archivo PDF</h2>
                        <p class="text-xs text-gray-500 mb-2">Seleccione un archivo PDF para el libro.</p>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-[#F1F5F9] shadow-sm">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <input type="file" id="archivo_pdf" name="archivo_pdf" accept="application/pdf" class="mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 text-center mt-2">Examine para seleccionar</p>
                        </div>
                    </section>
    
                    <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                        <h2 class="text-lg font-medium text-[#020617] mb-2">Archivo EPUb</h2>
                        <p class="text-xs text-gray-500 mb-2">Seleccione un archivo PDF para el libro.</p>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-[#F1F5F9] shadow-sm">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <input type="file" id="archivo_epub" name="archivo_epub" accept="application/epub+zip" class="mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 text-center mt-2">Examine para seleccionar</p>
                        </div>
                    </section>
                </div>
    
                <!-- Configuracion adicional -->
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-semibold text-[#09224B] mb-4">Configuración adicional</h2>
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-[#E2E8F0]">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Desactivar</h3>
                            <p>Marque la casilla para desactivar el libro</p>
                        </div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="desactivar" name="desactivar" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer
                                        peer-checked:bg-[#09224B] peer-checked:after:translate-x-full 
                                        rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white 
                                        after:content-[''] after:absolute after:top-[2px] after:start-[2px] 
                                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                                        after:h-5 after:w-5 after:transition-all ">
                            </div>
                        </label>
                    </div>
    
                    <!-- Botón de Envío -->
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-6 py-2 bg-[#09224B] text-white rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">Crear Libro
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload w-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                    </button>
                    
                </div>
                </section>
        
            </form>
        </div>

        <!-- Contenedor para la lista de libros -->
        <div id="tab-view-books" class="tab-content hidden">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Listado de Libros</h2>
            <!-- Agrega aquí tu vista o tabla para mostrar libros -->
            <!-- Tabla dinámica de libros -->
            <div class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
            <!-- Buscador dinámico -->
            <div class="mb-4 relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" id="search-input" placeholder="Buscar por título, autor o ISBN..." class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <!--Total de libros-->
            <p class="text-sm text-gray-500 mt-4">Total de libros: <span id="total-books">0</span></p>
            <!--Tabla de libros-->
            <table id="books-table" class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
                <thead>
                <tr class="">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Calificación</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200"></tbody>
            </table>
            <!-- Contenedor para los controles de paginación -->
            <div id="pagination" class="mt-4 flex gap-2"></div>
            </div>
        </div>
    </div>

    <!-- Contenedor oculto para editar libro -->
    <div id="edit-book-container" class="hidden mt-4">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Editar Libro</h2>
        <form id="editBookForm" enctype="multipart/form-data">
            <!-- Formulario similar al de creación -->
            <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                <h2 class="text-md font-semibold text-gray-900 mb-4">Informacion Basica</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <!-- Título -->
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título:</label>
                            <input type="text" id="titulo" name="titulo" required maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el título">
                        </div>
    
                        <div>
                            <!-- ISBN -->
                            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-1">ISBN:</label>
                            <input type="text" id="isbn" name="isbn" required maxlength="13" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el ISBN">
                        </div>
    
                        <div>
                            <!-- Calificación -->
                            <label for="calificacion" class="block text-sm font-medium text-gray-700 mb-1">Calificación:</label>
                            <input type="number" step="0.01" id="calificacion" name="calificacion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa la calificación">
                        </div>
    
                        <div>
                            <!-- Autor -->
                            <label for="autor" class="block text-sm font-medium text-gray-700 mb-1">Autor:</label>
                            <input type="text" id="autor" name="autor" required maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el autor">
                        </div>
    
                        <div>
                            <!-- Coordinado por -->
                            <label for="coordinado_por" class="block text-sm font-medium text-gray-700 mb-1">Coordinado por:</label>
                            <input type="text" id="coordinado_por" name="coordinado_por" maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el coordinador">
                        </div>
                    </div>
            </section>
            <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                <h2 class="text-lg font-medium text-[#09224B] mb-4">Detalle y precio</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <!-- Descripción -->
                            <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Descripcion del libro"></textarea>
                        </div>
    
                        <div>
                            <!-- Detalle -->
                            <label for="detalle" class="block text-sm font-medium text-gray-700 mb-1">Detalle:</label>
                            <textarea id="detalle" name="detalle" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Detalles del libro"></textarea>
                        </div>
    
                        <div>
                            <!-- Precio -->
                            <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio:</label>
                            <input type="number" step="0.01" id="precio" name="precio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
    
                        <div>
                            <!-- Tipo -->
                            <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo:</label>
                            <select id="tipo" name="tipo" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                <option value="gratuito">Gratuito</option>
                                <option value="de_pago">De Pago</option>
                            </select>
                        </div>
                    </div>
            </section>
            <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                <h2 class="text-lg font-medium text-[#09224B] mb-4">Categorías</h2>
                <div>
                    <label for="edit-categorias" class="block text-sm font-medium text-gray-700 mb-1">Selecciona las categorías:</label>
                    <select id="edit-categorias" name="categorias[]" multiple required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <!-- Opciones dinámicas -->
                    </select>
                </div>
            </section>
            <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                <h2 class="text-lg font-medium text-[#09224B] mb-4">Catálogos</h2>
                <div>
                    <label for="edit-catalogos" class="block text-sm font-medium text-gray-700 mb-1">Selecciona los catálogos:</label>
                    <select id="edit-catalogos" name="catalogos[]" multiple required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <!-- Opciones dinámicas -->
                    </select>
                </div>
            </section>
            <!-- Subida de documentos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-medium text-[#020617] mb-2">Imagen</h2>
                    <p class="text-xs text-gray-500 mb-2">Seleccione una imagen para el libro.</p>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-[#F1F5F9] shadow-sm">
                        <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg" class="mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 text-center mt-2">Examine para seleccionar</p>
                    </div>
                </section>

                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-medium text-[#020617] mb-2">Archivo PDF</h2>
                    <p class="text-xs text-gray-500 mb-2">Seleccione un archivo PDF para el libro.</p>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-[#F1F5F9] shadow-sm">
                        <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <input type="file" id="archivo_pdf" name="archivo_pdf" accept="application/pdf" class="mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 text-center mt-2">Examine para seleccionar</p>
                    </div>
                </section>

                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-medium text-[#020617] mb-2">Archivo EPUb</h2>
                    <p class="text-xs text-gray-500 mb-2">Seleccione un archivo PDF para el libro.</p>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center bg-[#F1F5F9] shadow-sm">
                        <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <input type="file" id="archivo_epub" name="archivo_epub" accept="application/epub+zip" class="mt-2 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 text-center mt-2">Examine para seleccionar</p>
                    </div>
                </section>
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-lg font-semibold text-[#09224B] mb-4">Configuración adicional</h2>
                    <div class="flex items-center justify-between p-4 bg-white rounded-lg border border-[#E2E8F0]">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Desactivar</h3>
                            <p>Marque la casilla para desactivar el libro</p>
                        </div>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="desactivar" name="desactivar" value="1" class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer
                                        peer-checked:bg-[#09224B] peer-checked:after:translate-x-full 
                                        rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white 
                                        after:content-[''] after:absolute after:top-[2px] after:start-[2px] 
                                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                                        after:h-5 after:w-5 after:transition-all ">
                            </div>
                        </label>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="px-6 py-2 bg-[#09224B] text-white rounded-md hover:bg-blue-800 flex items-center gap-2">
                            Actualizar Libro
                        </button>
                    </div>
                </section>
            </div>
            <input type="hidden" id="edit-id-libro" name="id_libro" />
        </form>
    </div>

    <div id="alertSuccess" class="fixed bottom-4 right-4 flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 hidden" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium" id="alertMessage">¡Libro creado!</span>
        </div>
    </div>

    <!-- Alerta de confirmación para eliminar -->
    <div id="alert-delete" class="hidden fixed bottom-4 right-4 p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
        <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium ms-1">Alerta!</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            Si eliminas este libro ya no se podra recuperar, ¿Estás seguro de eliminarlo?
        </div>
        <div class="flex">
            <button id="btnConfirmDelete" type="button" class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 
            font-medium rounded-lg text-xs px-3 py-1.5 me-2 inline-flex items-center">
            Aceptar
            </button>
            <button id="btnDismissDelete" type="button" class="text-yellow-800 bg-transparent border border-yellow-800 hover:bg-yellow-900 hover:text-white 
            focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5">
            Dismiss
            </button>
        </div>
    </div>

    <script>
        document.getElementById('formLibro').addEventListener('submit', function(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            
            fetch('{{ url('/api/books') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Mantén solo el token si es necesario
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.message){
                    // Mostrar alerta
                    const alertBox = document.getElementById('alertSuccess');
                    const alertMessage = document.getElementById('alertMessage');
                    alertMessage.textContent = data.message;
                    alertBox.classList.remove('hidden');
                    // Ocultar después de 5 segundos
                    setTimeout(() => {
                        alertBox.classList.add('hidden');
                    }, 5000);

                    form.reset();
                    // Actualizar la lista de libros
                    fetch('/api/books', {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        booksData = data.libros || [];
                        updateTable();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al crear el libro.');
            });
        });
        </script>

        <script>
        let booksData = [];
        let currentPage = 1;
        const itemsPerPage = 5;

        function renderTable(libros) {
            const tbody = document.querySelector('#books-table tbody');
            tbody.innerHTML = '';
            libros.forEach(book => {
            const tipoClass = book.tipo === 'gratuito' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800';
            const precio = parseFloat(book.precio || 0).toFixed(2);
            const calificacion = parseFloat(book.calificacion || 0).toFixed(1);

            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td class="px-6 py-4 whitespace-nowrap">
                <img
                  src="{{ asset('storage/') }}/${book.imagen}"
                  alt="${book.titulo}"
                  class="object-cover rounded-sm w-10"
                />
              </td>
                <td class="px-6 py-4 whitespace-nowrap max-w-[195px]">
                  <div class="text-sm font-medium text-gray-900 truncate" title="${book.titulo}">${book.titulo}</div>
                </td>
              <td class="px-6 py-4 whitespace-nowrap max-w-[195px]">
                <div class="text-sm text-gray-500 truncate" title="${book.autor}">${book.autor}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-mono text-gray-500">${book.isbn}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                  ${calificacion}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${tipoClass}">
                  ${book.tipo === 'gratuito' ? 'Gratuito' : 'De Pago'}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-500">$${precio}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <label class="relative inline-flex items-center cursor-pointer">
                  <input
                    type="checkbox"
                    class="sr-only peer estado-switch"
                    data-id="${book.id_libro}"
                    ${book.desactivar ? 'checked' : ''}
                  />
                  <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 
                      rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white 
                      after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white 
                      after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 
                      after:transition-all peer-checked:bg-blue-600">
                  </div>
                </label>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center space-x-2 justify-center align-content-center">
                <button class="text-[#09224B] hover:text-indigo-900 edit-book" data-id="${book.id_libro}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                  </svg>
                </button>
                <button class="text-red-600 hover:text-red-900 delete-book" data-id="${book.id_libro}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </td>
            `;
            tbody.appendChild(tr);
            });
        }

        // Función para renderizar la paginación
        function renderPagination() {
            const pagination = document.querySelector('#pagination');
            pagination.innerHTML = '';
            const totalPages = Math.ceil(booksData.length / itemsPerPage);
            if (totalPages <= 1) return;
            
            for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement('button');
            button.textContent = i;
            button.classList.add('px-3','py-1','border','rounded');
            if (i === currentPage) {
                button.classList.add('bg-[#09224B]','text-white');
            }
            button.addEventListener('click', () => {
                currentPage = i;
                updateTable();
            });
            pagination.appendChild(button);
            }
        }

        // Función para actualizar la tabla de libros
        function updateTable() {
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = booksData.slice(start, end);
            renderTable(pageData);
            renderPagination();
            // Actualizar el total de libros
            document.getElementById('total-books').textContent = booksData.length;
        }
        // Listener para el formulario de edición
        document.addEventListener('DOMContentLoaded', () => {
            const tabButtons = document.querySelectorAll('#tabs button[data-tab]');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active','text-blue-600','border-blue-600', 'text-gray-500', 'border-transparent'));
                    button.classList.add('active','text-blue-600','border-blue-600');

                    tabContents.forEach(content => content.classList.add('hidden'));
                    const targetId = 'tab-' + button.getAttribute('data-tab');
                    document.getElementById(targetId).classList.remove('hidden');
                });
            });

            // Establecer el tab "Agregar libro" como activo por defecto
            const defaultTab = document.querySelector('button[data-tab="add-book"]');
            defaultTab.classList.add('active', 'text-blue-600', 'border-blue-600');
            document.getElementById('tab-add-book').classList.remove('hidden');

            const searchInput = document.getElementById('search-input');

            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                if (query.length === 0) {
                    // Si el campo está vacío, mostrar todos los libros
                    fetch('/api/books', {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        booksData = data.libros || [];
                        currentPage = 1;
                        updateTable();
                    })
                    .catch(error => console.error('Error:', error));
                    return;
                }

                // Realizar búsqueda mediante POST
                fetch('/api/books/search', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ search: query })
                })
                .then(response => response.json())
                .then(data => {
                    booksData = data.libros || [];
                    currentPage = 1;
                    updateTable();
                })
                .catch(error => console.error('Error:', error));
            });

            // Cargar todos los libros al inicio
            fetch('/api/books', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                booksData = data.libros || [];
                total = data.total || 0;
                updateTable();
            })
            .catch(error => console.error('Error:', error));

            // Listener para los switches de Estado
            document.querySelector('#books-table tbody').addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('estado-switch')) {
                    const checkbox = e.target;
                    const libroId = checkbox.getAttribute('data-id');
                    const isDesactivar = checkbox.checked;

                    const endpoint = isDesactivar ? `/api/books/desactivate/${libroId}` : `/api/books/activate/${libroId}`;
                    const method = 'PUT';

                    fetch(endpoint, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.message){
                            alert(data.message);
                            // Actualizar el estado localmente si es necesario
                        } else {
                            alert('Acción realizada exitosamente.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al actualizar el estado del libro.');
                        // Revertir el estado del checkbox en caso de error
                        checkbox.checked = !isDesactivar;
                    });
                }
            });

            let libroIdAEliminar = null;

            // Eliminar libro
            document.querySelector('#books-table tbody').addEventListener('click', function (e) {
                const deleteButton = e.target.closest('.delete-book');
                if (deleteButton) {
                    libroIdAEliminar = deleteButton.getAttribute('data-id');
                    document.getElementById('alert-delete').classList.remove('hidden');
                }
            });

            // Confirmar eliminación
            document.getElementById('btnConfirmDelete').addEventListener('click', () => {
                if(!libroIdAEliminar) return;
                fetch(`/api/books/${libroIdAEliminar}`, {
                    method: 'DELETE',
                    headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                if(data.message){
                    const alertBox = document.getElementById('alertSuccess');
                    const alertMessage = document.getElementById('alertMessage');
                    alertMessage.textContent = data.message;
                    alertBox.classList.remove('hidden');
                    setTimeout(() => alertBox.classList.add('hidden'), 5000);
                    libroIdAEliminar = null;
                    document.getElementById('alert-delete').classList.add('hidden');
                    // Actualizar tabla
                    fetch('/api/books')
                    .then(res => res.json())
                    .then(data => {
                        booksData = data.libros || [];
                        updateTable();
                    });
                }
                })
                .catch(error => console.error('Error:', error));
            });

            // Dismiss eliminación
            document.getElementById('btnDismissDelete').addEventListener('click', () => {
                libroIdAEliminar = null;
                document.getElementById('alert-delete').classList.add('hidden');
            });

            // Editar libro
            document.querySelector('#books-table tbody').addEventListener('click', function(e) {
                const editButton = e.target.closest('.edit-book');
                if (editButton) {
                    const libroId = editButton.getAttribute('data-id');
                    fetch(`/api/books/${libroId}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        const libro = data.libro;
                        console.log(libro); // Agregar registro en la consola

                        // Mostrar el contenedor de edición
                        document.getElementById('edit-book-container').classList.remove('hidden');
                        // Asignar valores a los campos
                        document.getElementById('edit-id-libro').value = libro.id_libro;
                        document.querySelector('#editBookForm #titulo').value = libro.titulo || '';
                        document.querySelector('#editBookForm #isbn').value = libro.isbn || '';
                        document.querySelector('#editBookForm #calificacion').value = libro.calificacion || '';
                        document.querySelector('#editBookForm #autor').value = libro.autor || '';
                        document.querySelector('#editBookForm #coordinado_por').value = libro.coordinado_por || '';
                        document.querySelector('#editBookForm #descripcion').value = libro.descripcion || '';
                        document.querySelector('#editBookForm #detalle').value = libro.detalle || '';
                        document.querySelector('#editBookForm #precio').value = libro.precio || '';
                        document.querySelector('#editBookForm #tipo').value = libro.tipo || '';
                        // Checkbox "desactivar"
                        document.querySelector('#editBookForm #desactivar').checked = !!libro.desactivar;

                        // Establecer categorías seleccionadas
                        (libro.categorias || []).forEach(categoria => {
                            const option = document.querySelector(`#edit-categorias option[value="${categoria.id_categoria}"]`);
                            if(option) option.selected = true;
                        });

                        // Establecer catálogos seleccionados
                        (libro.catalogos || []).forEach(catalogo => {
                            const option = document.querySelector(`#edit-catalogos option[value="${catalogo.id_catalogo}"]`);
                            if(option) option.selected = true;
                        });

                    })
                    .catch(error => {
                        console.error('Error al obtener el libro:', error);
                    });
                }
            });

            // Manejo de la actualización con PUT
            document.getElementById('editBookForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const formData = new FormData(form);
                formData.append('_method', 'PUT');

                const libroId = formData.get('id_libro');

                fetch(`/api/books/${libroId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.message){
                        const alertBox = document.getElementById('alertSuccess');
                        const alertMessage = document.getElementById('alertMessage');
                        alertMessage.textContent = data.message;
                        alertBox.classList.remove('hidden');
                        setTimeout(() => {
                            alertBox.classList.add('hidden');
                        }, 5000);
                        // Ocultar el contenedor y actualizar la tabla
                        document.getElementById('edit-book-container').classList.add('hidden');
                        // Fetch y actualizar la lista de libros
                        fetch('/api/books', {
                            method: 'GET'
                        })
                        .then(response => response.json())
                        .then(data => {
                            booksData = data.libros || [];
                            currentPage = 1;
                            updateTable();
                        })
                        .catch(error => console.error('Error:', error));
                    } else if(data.errors){
                        console.log(data.errors);
                        alert('Hay errores en el formulario. Revisa la consola para más detalles.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al actualizar el libro.');
                });
            });

            // Cargar categorías dinámicamente
            fetch('/api/categorias')
                .then(response => response.json())
                .then(data => {
                    const categoriasSelect = document.getElementById('categorias');
                    data.forEach(categoria => {
                        const option = document.createElement('option');
                        option.value = categoria.id_categoria;
                        option.textContent = categoria.nombre_categoria;
                        categoriasSelect.appendChild(option);
                    });

                    // Cargar categorías en el formulario de edición
                    const editCategoriasSelect = document.getElementById('edit-categorias');
                    data.forEach(categoria => {
                        const option = document.createElement('option');
                        option.value = categoria.id_categoria;
                        option.textContent = categoria.nombre_categoria;
                        editCategoriasSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar categorías:', error));

            // Cargar catálogos dinámicamente
            fetch('/api/catalogos')
                .then(response => response.json())
                .then(data => {
                    const catalogosSelect = document.getElementById('catalogos');
                    data.forEach(catalogo => {
                        const option = document.createElement('option');
                        option.value = catalogo.id_catalogo;
                        option.textContent = catalogo.nombre_catalogo;
                        catalogosSelect.appendChild(option);
                    });

                    // Cargar catálogos en el formulario de edición
                    const editCatalogosSelect = document.getElementById('edit-catalogos');
                    data.forEach(catalogo => {
                        const option = document.createElement('option');
                        option.value = catalogo.id_catalogo;
                        option.textContent = catalogo.nombre_catalogo;
                        editCatalogosSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar catálogos:', error));
        });

    </script>
@endsection
