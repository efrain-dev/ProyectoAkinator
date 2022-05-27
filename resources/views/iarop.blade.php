@extends('layout')
@section('titulo')
    I.A.R.OP
@endsection

@section('nombre')
    I.A.R.OP
@endsection

@section('contenido')

    <div class="container my-5 rounded shadow-lg border bg-white" style="">
        {!! $mensaje !!}

        <div class="d-flex justify-content-between my-5">
            <a href='/iarop/?n=1&r=0' class="btn btn-success  col-6">Volver a probar</a>
            <a href="{{route('ver')}}" class="btn btn-warning  col-6">Datos de I.A.R.OP</a>
        </div>

    </div>

@endsection
