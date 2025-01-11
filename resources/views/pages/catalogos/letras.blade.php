@extends('layouts.app')
@section('title', 'Home | Catalogos - LETRAS SIN PAPEL')

@section('content')
    <!-- Contenido específico de la página de LETRAS SIN PAPEL -->
    @include('components.heroimagen')
    <div class="container">
        @include('components.sidebarComponent')
        <h1>Sección de catalogos - LETRAS SIN PAPEL</h1>
        <p>Aquí se mostrarán los libros de  LETRAS SIN PAPEL de la Editorial UNACH.</p>
        <!-- ...más contenido específico... -->
    </div>
@endsection