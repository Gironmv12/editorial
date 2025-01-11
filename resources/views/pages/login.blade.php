@extends('layouts.app')
@section('title', 'Home | Iniciar Sesión')

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

                <div class="bg-[#E9FBFF] p-6 rounded-xl">
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
                        Ingresar a tu cuenta
                    </h2>

                    @if ($errors->has('error'))
                        <div class="mb-4 text-red-600">
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-900">
                                Correo electrónico
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                required
                            />
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-900">
                                Contraseña
                            </label>
                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="contrasena"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    required
                                />
                                <!-- Botón para mostrar/ocultar contraseña -->
                                <button
                                    type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
                                    onclick="togglePasswordVisibility()"
                                >
                                    <!-- Icono de ojo -->
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-[#003D75] text-white py-2 px-4 rounded-md hover:bg-blue-800 transition-colors"
                        >
                            Iniciar sesión
                        </button>

                        <p class="text-center text-sm text-gray-600">
                            ¿No tienes cuenta? 
                            <a href="{{ route('registro') }}" class="text-blue-600 hover:underline">
                                Regístrate aquí
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
