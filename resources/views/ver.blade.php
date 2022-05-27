@extends('layout')
@section('titulo')
    I.A.R.OP
@endsection

@section('nombre')
    I.A.R.OP
@endsection

@section('contenido')

    <div class="container my-5 rounded shadow-lg border bg-white" style="">
        <div class="row">
            <canvas id="myChart" width="400" height="200"></canvas>
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
            <a href='/iarop/?n=1&r=0' class="btn btn-success  col-12">Volver a probar</a>
        </div>

    </div>


@endsection
@push('script')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Personajes Registrados', 'Aciertos', 'Fallos'],
                datasets: [{
                    label: 'TOTAL',
                    data: [{{$cantidad}}, {{$aciertos}} ,{{$fallos}}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',

                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endpush
