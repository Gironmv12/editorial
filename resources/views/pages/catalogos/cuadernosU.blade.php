@extends('layouts.app')
@section('title', 'Home | Catalogos - Cuadernos Universitarios')

@section('content')
    <!-- Contenido específico de la página de cuadernos universitarios -->
    @include('components.heroimagen')
    <div class="container">
        @include('components.sidebarComponent')
        <h1>Sección de catalogos - cuadernos universitarios</h1>
        <p>Aquí se mostrarán los libros de  cuadernos universitarios de la Editorial UNACH.</p>
        <!-- ...más contenido específico... -->
    </div>
@endsection