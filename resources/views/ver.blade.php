@extends('layout')
@section('titulo')
    Akinator
@endsection

@section('nombre')
    AKINATOR
@endsection

@section('contenido')
    <div class="row">
        <div class="col-12 d-flex justify-content-start">
            <h4>Personajes Registrados {{$cantidad}}</h4>
        </div>
        <div class="dropdown-divider"></div>
        <div class="col-12 d-flex justify-content-start">
            <h4>Aciertos {{$aciertos}}</h4>
        </div>
        <div class="dropdown-divider"></div>
        <div class="col-12 d-flex justify-content-start">
            <h4>Fallos {{$fallos}}</h4>
        </div>
        <div class="dropdown-divider"></div>
        <div class="col-12 ">
            <h4 class="text-center">Personajes</h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Nombre</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personajes as $personaje)
                        <tr>
                            <td>{{$personaje->personaje}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between my-5">
        <a href='/?n=1&r=0' class="btn btn-success  col-12">Volver a probar</a>
    </div>

@endsection
