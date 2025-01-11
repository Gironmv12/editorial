@extends('layouts.app')
@section('title', 'Home | Catalogos - Eventos')

@section('content')
    <!-- Contenido específico de la página de Eventos  -->
    @include('components.heroimagen')
    <div class="container">
        @include('components.sidebarComponent')
        <h1>Sección de catalogos - Eventos</h1>
        <p>Aquí se mostrarán los libros de Eventos de la Editorial UNACH.</p>
        <!-- ...más contenido específico... -->
    </div>
@endsection