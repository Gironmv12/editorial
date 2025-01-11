@extends('dashboard.app')
@section('title', 'Usuarios')

@section('content')
<!-- Contenido específico de la página de categorias dashboard -->
<div class="container bg-[#F8FAFD]">
    <div class="w-full p-6 bg-[#EBF3FE] rounded-lg mb-6">
        <h2 class="text-xl font-semibold mb-4 text-[#005295]">Gestion de usuarios</h2>
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
                            <span class="ms-1 text-sm font-medium text-gray-400 md:ms-2">Usuarios</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </nav>
    </div>

    <form id="formUsuarios" enctype="multipart/form-data">
        <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
            <h2 class="text-md font-semibold text-gray-900 mb-4">Crear un nuevo usuario</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nombre_usuario" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Usuario:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" required maxlength="255" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el nombre de usuario">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa el correo electrónico">
                </div>

                <div>
                    <label for="contrasena" class="block text-sm font-medium text-gray-700 mb-1">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required minlength="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingresa la contraseña">
                </div>

                <div>
                    <label for="rol" class="block text-sm font-medium text-gray-700 mb-1">Rol:</label>
                    <select id="rol" name="rol" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="user" >Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" id="btnCatalogoAccion" class="px-6 py-2 bg-[#09224B] text-white rounded-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                    Crear usuario
                </button>
            </div>
        </section>
    </form>
    
    <section class="bg-white rounded-lg p-6 mt-6 border border-[#E2E8F0]">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Opciones</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios" class="bg-white divide-y divide-gray-200">
                <!-- Se llenará dinámicamente -->
            </tbody>
        </table>
        <div class="mt-4 flex justify-center" id="paginationCatalogo"></div>
    </section>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--Consumo de apis y funcionaldiades con JAX -->
<script>
    $(document).ready(function() {
        let users = [];
        const itemsPerPage = 5;
        let currentPage = 1;
        let editUserId = null; // Variable para almacenar el ID del usuario en edición

        $('#formUsuarios').submit(function(event) {
            event.preventDefault();

            const formData = {
                nombre_usuario: $('#nombre_usuario').val(),
                email: $('#email').val(),
                rol: $('#rol').val(),
            };

            const contrasena = $('#contrasena').val();
            if (editUserId) {
                if (contrasena.trim() !== '') {
                    formData.contrasena = contrasena;
                }
            } else {
                formData.contrasena = contrasena;
            }

            if (editUserId) {
                // Modo edición
                $.ajax({
                    url: `/api/users/${editUserId}`,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        alert('Usuario actualizado exitosamente.');
                        $('#formUsuarios')[0].reset();
                        $('#btnCatalogoAccion').text('Crear usuario');
                        $('#btnCancelar').remove();
                        $('#contrasena').attr('required', 'required'); // Restaurar 'required'
                        editUserId = null;
                        obtenerUsuarios();
                    },
                    error: function(xhr) {
                        alert('Error al actualizar el usuario.');
                    }
                });
            } else {
                // Modo creación
                $.ajax({
                    url: '/api/users',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Usuario creado exitosamente.');
                        $('#formUsuarios')[0].reset();
                        obtenerUsuarios();
                    },
                    error: function(xhr) {
                        alert('Error al crear el usuario.');
                    }
                });
            }
        });

        // Función para obtener y mostrar usuarios
        function obtenerUsuarios() {
            $.ajax({
                url: '/api/users',
                type: 'GET',
                success: function(response) {
                    users = response;
                    currentPage = 1;
                    renderTabla();
                    renderPagination();
                },
                error: function(xhr) {
                    alert('Error al obtener los usuarios.');
                }
            });
        }

        // Función para renderizar la tabla según la página actual
        function renderTabla() {
            const tabla = $('#tablaUsuarios');
            tabla.empty();
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedItems = users.slice(start, end);

            paginatedItems.forEach(usuario => {
                tabla.append(`
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500 truncate">${usuario.id_usuario}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500 truncate">${usuario.nombre_usuario}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500 truncate">${usuario.email}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-500 truncate">${usuario.rol}</div></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-[#09224B] edit-user" data-id="${usuario.id_usuario}"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg></button>
                            <button class="text-red-600 delete-user" data-id="${usuario.id_usuario}"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg></button>
                        </td>
                    </tr>
                `);
            });
        }

        // Función para renderizar la paginación
        function renderPagination() {
            const totalPages = Math.ceil(users.length / itemsPerPage);
            const pagination = $('#paginationCatalogo');
            pagination.empty();

            // Botón "Anterior"
            pagination.append(`
                <button class="pagination-button mx-1 px-3 py-1 text-sm bg-gray-300 rounded ${currentPage === 1 ? 'disabled:opacity-50' : ''}"
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
                <button class="pagination-button mx-1 px-3 py-1 text-sm bg-gray-300 rounded ${currentPage === totalPages ? 'disabled:opacity-50' : ''}"
                    data-page="${currentPage + 1}" ${currentPage === totalPages ? 'disabled' : ''}>Siguiente</button>
            `);
        }

        // Evento dinámico para botones de paginación
        $(document).on('click', '.pagination-button', function () {
            const page = parseInt($(this).data('page'), 10);
            const totalPages = Math.ceil(users.length / itemsPerPage);
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderTabla();
                renderPagination();
            }
        });

        // Evento para el botón "Editar"
        $(document).on('click', '.edit-user', function () {
            const userId = $(this).data('id');
            const user = users.find(u => u.id_usuario === userId);
            if (user) {
                $('#nombre_usuario').val(user.nombre_usuario);
                $('#email').val(user.email);
                $('#contrasena').val(''); // Dejar vacío por seguridad
                $('#rol').val(user.rol);
                $('#btnCatalogoAccion').text('Guardar cambios');
                if ($('#btnCancelar').length === 0) {
                    $('#btnCatalogoAccion').after(`<button type="button" id="btnCancelar" class="ml-2 px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancelar</button>`);
                }
                $('#contrasena').removeAttr('required'); // Eliminar 'required'
                editUserId = userId;
            }
        });

        // Evento para el botón "Cancelar"
        $(document).on('click', '#btnCancelar', function () {
            $('#formUsuarios')[0].reset();
            $('#btnCatalogoAccion').text('Crear usuario');
            $(this).remove();
            $('#contrasena').attr('required', 'required'); // Restaurar 'required'
            editUserId = null;
        });

        // Evento para el botón "Eliminar"
        $(document).on('click', '.delete-user', function () {
            const userId = $(this).data('id');
            if (confirm('¿Estás seguro de eliminar este usuario?')) {
                $.ajax({
                    url: `/api/users/${userId}`,
                    type: 'DELETE',
                    success: function(response) {
                        alert('Usuario eliminado exitosamente.');
                        obtenerUsuarios();
                    },
                    error: function(xhr) {
                        alert('Error al eliminar el usuario.');
                    }
                });
            }
        });

        // Llamar a la función al cargar la página
        obtenerUsuarios();
    });
</script>
@endsection