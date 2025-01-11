@extends('layouts.app')
@section('title', 'Home | Catalogos - Lee UNACH')

@section('content')
    <!-- Contenido específico de la página de Lee UNACH -->
    @include('components.heroimagen')
    <div class="container">
        @include('components.sidebarComponent')
        <h1>Sección de catalogos - Lee UNACH</h1>
        <p>Aquí se mostrarán los libros de Lee UNACH de la Editorial UNACH.</p>
        <!-- ...más contenido específico... -->
    </div>
@endsection