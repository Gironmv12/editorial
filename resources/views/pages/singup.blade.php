@extends('layouts.app')
@section('title', 'Home | Registro')

@section('content')
    <div class="min-h-min bg-white p-6 md:p-12">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12">
            <!-- Left Column -->
            <div class="space-y-6">
                <div class="space-y-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-blue-900">
                        Bienvenido a la biblioteca digital de UNACH
                    </h1>
                    <p class="text-gray-600">
                        Descubre, compara y disfruta de nuestra colección de libros digitales. Una experiencia única de lectura te espera.
                    </p>
                </div>

                <div class="bg-blue-50 p-6 rounded-xl">
                    <h2 class="font-semibold mb-4 text-[#003D75]">¿Qué puedes hacer?</h2>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5 6.5L9.5 17.5L4.5 12.5" stroke="#0066E6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-[#0066E6]">Acceder a libros digitales exclusivos</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5 6.5L9.5 17.5L4.5 12.5" stroke="#0066E6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-[#0066E6]">Comparar diferentes obras</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5 6.5L9.5 17.5L4.5 12.5" stroke="#0066E6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-[#0066E6]">Guardar tus libros favoritos</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.5 6.5L9.5 17.5L4.5 12.5" stroke="#0066E6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text-[#0066E6]">Ver videos relacionados</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Column -->
            <div class="bg-white p-5 rounded-2xl shadow-lg">
                <div class="max-w-md mx-auto space-y-5">
                    <h2 class="text-2xl font-bold text-blue-900 mb-2 text-center">
                        Crea una cuenta
                    </h2>

                    @if ($errors->has('error'))
                        <div class="mb-4 text-red-600">
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label for="nombre_usuario" class="block text-sm font-medium text-gray-900">Nombre de usuario</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" id="nombre_usuario" name="nombre_usuario" required>
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-900">Correo electrónico</label>
                            <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" id="email" name="email" required>
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-900">Contraseña</label>
                            <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" id="password" name="contrasena" required>
                        </div>
                        <button type="submit" class="mt-4 w-full bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-800 transition-colors">Registrarse</button>
                        <!-- Adventencia minimo 8 caracteres -->
                        <div class="p-4 mt-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                            <span class="font-medium">Aviso!</span> Mínimo 8 caracteres, incluye mayúsculas, minúsculas y números
                          </div>
                        <!-- Enlace a la página de inicio de sesión -->
                        
                        <p class="text-center text-sm text-gray-600 mt-4">
                            ¿Ya tienes una cuenta? 
                            <a href="{{ route('loginpage') }}" class="text-blue-600 hover:underline">Iniciar sesión</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
