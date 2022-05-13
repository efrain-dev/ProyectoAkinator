@extends('layout')
@section('titulo')
    Akinator
@endsection

@section('nombre')
    AKINATOR
@endsection

@section('contenido')
    {!! $mensaje !!}

    <div class="d-flex justify-content-between my-5">
        <a href='/?n=1&r=0' class="btn btn-success  col-6">Volver a probar</a>
        <a href='datos.php' class="btn btn-warning  col-6">Datos de Javinator</a>
    </div>

@endsection
