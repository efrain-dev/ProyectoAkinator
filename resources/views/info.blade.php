@extends('layout')
@section('titulo')
    I.A.R.OP
@endsection

@section('nombre')
    Informacion
@endsection

@section('contenido')

    <div class="container bg-white rounded shadow-lg">
        <div class="row">
            <div class="col-lg-6 my-3">
                <h1 class="text-center">Resumen</h1>
                <p style="text-align: justify">Este proyecto se enfoca al aprendizaje de cognitivo y adquisición de
                    conocimientos de los estudiantes de primaria, todo joven con capacidad de lectura perteneciente a
                    los grados de primero primaria en adelante tiene las capacidades de lectura y análisis para poner a
                    prueba sus capacidades intelectuales con esta aplicación de entretenimiento y aprendizaje.
                    Centrarse en enseñar a los jóvenes sobre los objetos que se encuentran en nuestros hogares o
                    instituciones. Al utilizar la aplicación web, puede acceder al uso del software.
                    Implementar esto en instituciones públicas del sector primario beneficiará a los profesores para
                    brindarles a los estudiantes entretenimiento y diversión por un corto período de tiempo, mientras
                    continúan usando la aplicación desarrollada para el aprendizaje.</p>
                <div class="text-center">

                    <img src="{{asset('img/icon.jpeg')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 my-3">
                <h1 class="text-center">Objetivos</h1>
                <p style="text-align: justify">Desarrollar una IA con los conocimientos adquiridos en el Curso de
                    Inteligencia Artificial, poniendo en práctica nuevas tecnologías y servicios proporcionados por
                    empresas dedicadas al desarrollo de nuevas tecnologías otorgando accesibilidad a estas para el
                    desarrollo de nuevas herramientas para el uso de la comunidad.
                    Enforcar la enseñanza a los jóvenes sobre el aprendizaje de los objetos que se encuentran en
                    nuestros hogares o establecimientos. Mientras utilizan una aplicación web, la cual da accesibilidad
                    al uso de este software</p>
                <div class="text-center">

                    <img src="{{asset('img/obj.jpg')}}" style="width: 45vh" alt="">
                </div>
            </div>
            <div class="col-lg-12 my-3">
                <h1 class="text-center">INTRODUCCION</h1>
                <p style="text-align: justify">Las IA (inteligencia artificial) son implementadas en sectores comerciales, para conocer el patrón de compras sobre los clientes, reconocimientos faciales, bloqueos sobre bots y reconocimientos de voz. Normalmente estas se desarrollan para un uso específico que beneficie a una entidad en concreto y poder mejorar sus sistemas e información para conseguir mejores resultados y esté elevar las ganancias sobre la empresa.
                    En escuelas estas no son implementadas de manera directa, un estudiante puede investigar, pero solo conocerá que existen si es del interés del estudiante, no existen normativas que exijan o introduzcan este tipo de tecnologías. La implementación de una IA en estos establecimientos de manera gratuita y no lucrativa podría beneficiar al desarrollo cognitivo y aprendizaje de los alumnos por medio de la interacción y observación de los resultados que pueda ofrecer la IA.</p>
                <div class="text-center">

                    <img src="{{asset('img/icon.jpeg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
