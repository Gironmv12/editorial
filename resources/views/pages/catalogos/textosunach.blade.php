@extends('layouts.app')
@section('title', 'Home | Catalogos - Textos UNACH')

@section('content')
    <!-- Contenido específico de la página de Textos UNACH -->
    @include('components.heroimagen')
    <div class="container">
        @include('components.sidebarComponent')
        <h1>Sección de catalogos - Textos UNACH</h1>
        <p>Aquí se mostrarán los libros de Textos UNACH de la Editorial UNACH.</p>
        <!-- ...más contenido específico... -->
    </div>
@endsection