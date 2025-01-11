@extends('dashboard.app')
@section('title', 'Categorias')

@section('content')
    <!-- Contenido específico de la página de categorias dashboard -->
    <div class="container bg-[#F8FAFD]">
        <div class="w-full p-6 bg-[#EBF3FE] rounded-lg mb-6">
            <h2 class="text-xl font-semibold mb-4 text-[#005295]">Crear categorias & catalogos</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <!-- Breadcrumb content -->
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
                                <span class="ms-1 text-sm font-medium text-gray-400 md:ms-2">Categorias</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </nav>
        </div>
        
        <div class="mb-6">
            <ul class="flex border-b border-gray-200" id="tabs">
                <li>
                    <button type="button" class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 inline-flex items-center gap-2 active" data-tab="add-categorias">
                        <!-- Icono para "Categorias" -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Agregar categoria
                    </button>
                </li>
                <li>
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600 inline-flex items-center gap-2" data-tab="add-catalogos">
                        <!-- Icono para "Catalogos" -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Agregar Catalogo
                    </button>
                </li>
            </ul>
        </div>

        <!--Tab de categorias-->
        <div id="tab-add-categorias" class="tab-content">
            <!--Formulario -->
            <form id="formCategoria" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" id="categoria_id" name="categoria_id" />
                <input type="hidden" name="_method" id="method_override" />
                <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                    <h2 class="text-md font-semibold text-gray-900 mb-4">Crear una nueva categoria</h2>
                    <div class="">
                        <div>
                            <!-- Nombre de la categoria -->
                            <label for="nombre_categoria" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Categoría</label>
                            <input type="text" id="nombre_categoria" name="nombre_categoria" required maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Nombre de la categoria">
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" id="btnCategoriaAccion" class="px-6 py-2 bg-[#09224B] text-white rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                            Crear Categoria
                        </button>
                    </div>
                </section>
            </form>
            <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CATEGORIA</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCategorias" class="bg-white divide-y divide-gray-200">
                        <!-- Se llenará dinámicamente -->
                    </tbody>
                </table>
                <div class="mt-4 flex justify-center" id="pagination"></div>
            </section>
        </div>

        <div id="tab-add-catalogos" class="tab-content hidden">
            @include('dashboard.catalogo')
        </div> 
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('#tabs button');
            const contents = document.querySelectorAll('.tab-content');
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

            // Ocultar todas las pestañas excepto la predeterminada
            contents.forEach(content => content.classList.add('hidden'));

            // Activar la pestaña predeterminada
            const defaultTab = document.querySelector('button[data-tab="add-categorias"]');
            defaultTab.classList.add('text-blue-600', 'border-blue-600');
            document.getElementById('tab-add-categorias').classList.remove('hidden');

            // Manejar el clic en las pestañas
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    // Desactivar todas las pestañas y ocultar contenidos
                    tabs.forEach(t => {
                        t.classList.remove('text-blue-600', 'border-blue-600');
                    });
                    contents.forEach(c => c.classList.add('hidden'));

                    // Activar la pestaña clickeada y mostrar el contenido correspondiente
                    this.classList.add('text-blue-600', 'border-blue-600');
                    const contentId = 'tab-' + this.dataset.tab;
                    document.getElementById(contentId).classList.remove('hidden');
                });
            });
        });
    </script>

    <script>
    //Usar para consumir el edpoitn de categorias /api/categorias de tipo POST
    $(document).ready(function() {
        $('#formCategoria').submit(function(e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            let id = $('#categoria_id').val();
            if(id) {
                formData.append('_method', 'PUT');
            }
            $.ajax({
                url: id ? '/api/categorias/' + id : '/api/categorias',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(id ? 'Categoría actualizada con éxito' : 'Categoría creada con éxito');
                    $('#nombre_categoria').val('');
                    $('#categoria_id').val('');
                    $('#btnCategoriaAccion').text('Crear Categoria'); 
                    fetchCategorias(); // Actualizar la tabla después de crear una categoría
                },
                error: function(error) {
                    alert('Error al ' + (id ? 'actualizar' : 'crear') + ' la categoría');
                }
            });
        });

        let categoriesData = [];
        let currentPage = 1;
        const pageSize = 5;

        function fetchCategorias() {
            $.ajax({
                url: '/api/categorias',
                type: 'GET',
                success: function(response) {
                    categoriesData = response;
                    renderTable();
                    renderPagination();
                },
                error: function() {
                    alert('Error al obtener categorías');
                }
            });
        }

        function renderTable() {
            let startIndex = (currentPage - 1) * pageSize;
            let endIndex = startIndex + pageSize;
            let pageData = categoriesData.slice(startIndex, endIndex);
            let tablaBody = $('#tablaCategorias');
            tablaBody.empty();
            pageData.forEach(function(item) {
                let row = buildRow(item);
                tablaBody.append(row);
            });
        }

        function buildRow(item) {
            return `
                <tr>
                    <td class="px-6 py-4 whitespace-nowra">
                        <div class="text-sm text-gray-500 truncate">${item.id_categoria}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowra">
                        <div class="text-sm text-gray-500 truncate">${item.nombre_categoria}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex items-center space-x-2">
                        <button class="text-[#09224B] edit-categoria" data-id="${item.id_categoria}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                        </button>
                        <button class="text-red-600 delete-book" data-id="${item.id_categoria}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `;
        }

        function renderPagination() {
            let totalPages = Math.ceil(categoriesData.length / pageSize);
            let pagination = $('#pagination');
            pagination.empty();

            // Botón "Anterior"
            pagination.append(`
                <button class="mx-1 px-3 py-1 text-sm bg-gray-300 rounded disabled:opacity-50"
                    ${currentPage === 1 ? 'disabled' : ''}
                    onclick="goToPage(${currentPage - 1})">Anterior</button>
            `);

            // Páginas
            for (let i = 1; i <= totalPages; i++) {
                pagination.append(`
                    <button class="mx-1 px-3 py-1 text-sm rounded ${currentPage === i ? 'bg-[#09224B] text-white' : 'bg-gray-200'}"
                        onclick="goToPage(${i})">${i}</button>
                `);
            }

            // Botón "Siguiente"
            pagination.append(`
                <button class="mx-1 px-3 py-1 text-sm bg-gray-300 rounded disabled:opacity-50"
                    ${currentPage === totalPages ? 'disabled' : ''}
                    onclick="goToPage(${currentPage + 1})">Siguiente</button>
            `);
        }

        window.goToPage = function(page) {
            currentPage = page;
            renderTable();
            renderPagination();
        }

        $(document).on('click', '.edit-categoria', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '/api/categorias/' + id,
                type: 'GET',
                success: function(categoria) {
                    $('#categoria_id').val(categoria.id_categoria);
                    $('#nombre_categoria').val(categoria.nombre_categoria);
                    $('#btnCategoriaAccion').text('Guardar Cambios');
                },
                error: function() {
                    alert('Error al obtener categoría');
                }
            });
        });

        $(document).on('click', '.delete-book', function() {
            let id = $(this).data('id');
            if(!confirm('¿Deseas eliminar esta categoría?')) return;
            $.ajax({
                url: '/api/categorias/' + id,
                type: 'DELETE',
                success: function() {
                    alert('Categoría eliminada');
                    fetchCategorias();
                },
                error: function() {
                    alert('Error al eliminar la categoría');
                }
            });
        });

        fetchCategorias();
    });
    </script>
@endsection
