<!--Formulario -->
<form id="formCatalogo" enctype="multipart/form-data">
    <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
        <h2 class="text-md font-semibold text-gray-900 mb-4">Crear un nuevo catalogo</h2>
        <div class="">
            <div>
                <!-- Nombre del catalogo -->
                <label for="nombre_catalogo" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Catálogo</label>
                <input type="text" id="nombre_catalogo" name="nombre_catalogo" required maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Nombre del catalogo">
                <!-- Campo oculto para ID del catálogo -->
                <input type="hidden" id="catalogo_id" name="catalogo_id">
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <button type="submit" id="btnCatalogoAccion" class="px-6 py-2 bg-[#09224B] text-white rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                Crear Catalogo
            </button>
        </div>
    </section>
</form>

<section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
        <thead>
            <tr class="">
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CATALOGO</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OPCIONES</th>
            </tr>
        </thead>
        <tbody id="tablaCatalogos" class="bg-white divide-y divide-gray-200">
            <!-- Se llenará dinámicamente -->
        </tbody>
    </table>
    <div class="mt-4 flex justify-center" id="paginationCatalogo"></div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--Consumo de apis y funcionaldiades con JAX -->
<script>
    $(document).ready(function() {
        let catalogos = [];
        const itemsPerPage = 5;
        let currentPage = 1;

        $('#formCatalogo').submit(function(e) {
            e.preventDefault();
            const catalogoId = $('#catalogo_id').val();
            if (catalogoId) {
                // Modo editar
                $.ajax({
                    url: `/api/catalogos/${catalogoId}`,
                    type: 'PUT',
                    data: $(this).serialize(),
                    success: function(res) {
                        alert('Catálogo actualizado: ' + res);
                        $('#catalogo_id').val('');
                        $('#nombre_catalogo').val('');
                        $('#btnCatalogoAccion').text('Crear Catalogo');
                        cargarCatalogos();
                    },
                    error: function(err) {
                        alert('Error: ' + err);
                    }
                });
            } else {
                // Modo crear
                $.ajax({
                    url: '/api/catalogos',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        alert('Catálogo creado: ' + res);
                        $('#nombre_catalogo').val('');
                        cargarCatalogos();
                    },
                    error: function(err) {
                        alert('Error: ' + err);
                    }
                });
            }
        });

        function cargarCatalogos() {
            $.ajax({
                url: '/api/catalogos',
                type: 'GET',
                success: function(res) {
                    catalogos = res;
                    currentPage = 1;
                    renderTabla();
                    renderPagination();
                },
                error: function(err) {
                    alert('Error al cargar catálogos');
                }
            });
        }

        function renderTabla() {
            const $tabla = $('#tablaCatalogos');
            $tabla.empty();
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = catalogos.slice(start, end);
            paginatedItems.forEach(function(cat) {
                $tabla.append(`
                    <tr>
                        <td class="px-6 py-4 whitespace-nowra"><div class="text-sm text-gray-500 truncate">${cat.id_catalogo}</div></td>
                        <td class="px-6 py-4 whitespace-nowra"><div class="text-sm text-gray-500 truncate">${cat.nombre_catalogo}</div></td>
                        <td class="px-6 py-4 whitespace-nowra">
                            <button class="text-[#09224B] edit-catalogo" data-id="${cat.id_catalogo}"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg></button>
                            <button class="text-red-600 delete-categoria" data-id="${cat.id_catalogo}"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg></button>
                        </td>
                    </tr>
                `);
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(catalogos.length / itemsPerPage);
            const pagination = $('#paginationCatalogo');
            pagination.empty();

            // Botón "Anterior"
            pagination.append(`
                <button class="pagination-button mx-1 px-3 py-1 text-sm bg-gray-300 rounded disabled:opacity-50"
                    data-page="${currentPage - 1}" ${currentPage === 1 ? 'disabled' : ''}>Anterior</button>
            `);

            // Páginas
            for (let i = 1; i <= totalPages; i++) {
                pagination.append(`
                    <button class="pagination-button mx-1 px-3 py-1 text-sm rounded ${currentPage === i ? 'bg-[#09224B] text-white' : 'bg-gray-200'}"
                        data-page="${i}">${i}</button>
                `);
            }

            // Botón "Siguiente"
            pagination.append(`
                <button class="pagination-button mx-1 px-3 py-1 text-sm bg-gray-300 rounded disabled:opacity-50"
                    data-page="${currentPage + 1}" ${currentPage === totalPages ? 'disabled' : ''}>Siguiente</button>
            `);
        }

        // Evento dinámico para botones de paginación
        $(document).on('click', '.pagination-button', function () {
            const page = parseInt($(this).data('page'), 10);
            const totalPages = Math.ceil(catalogos.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTabla();
                renderPagination();
            }
        });

        // Evento para editar catálogo
        $(document).on('click', '.edit-catalogo', function () {
            const id = $(this).data('id');
            $.ajax({
                url: `/api/catalogos/${id}`,
                type: 'GET',
                success: function(cat) {
                    $('#nombre_catalogo').val(cat.nombre_catalogo);
                    $('#catalogo_id').val(cat.id_catalogo);
                    $('#btnCatalogoAccion').text('Guardar Cambios');
                },
                error: function(err) {
                    alert('Error al obtener el catálogo');
                }
            });
        });

        // Evento para eliminar catálogo
        $(document).on('click', '.delete-categoria', function () {
            if (confirm('¿Está seguro de que desea eliminar este catálogo?')) {
                const id = $(this).data('id');
                $.ajax({
                    url: `/api/catalogos/${id}`,
                    type: 'DELETE',
                    success: function(res) {
                        alert('Catálogo eliminado: ' + res);
                        cargarCatalogos();
                    },
                    error: function(err) {
                        alert('Error al eliminar el catálogo');
                    }
                });
            }
        });

        cargarCatalogos();
    });
</script>