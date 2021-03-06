<?php

namespace App\Http\Controllers;

use App\Models\Arbol;
use App\Models\Partida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AkinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function getImagenes($name)
    {
        $arbol = Arbol::where('texto', $name)->first();
        if ($arbol) {
            if ($arbol->url==null){
                $key = "eyJpdiI6IlVkZFd6OS9qdVpsMkVWSW1TK2xFeUE9PSIsInZhbHVlIjoiakpnOXZuNDVONzFZQzZxMjJPUHpmYUp6KzgzOUhIVlFWWThlMHIvMXYvY1lrdUxFb1JpaWtoSWZGb0tHdGhPNXVSZVY5RitJdG43MFVxL1JRRTJYMzlCSTdoZytjYitSVnBUZ3ZCc0VDN3ZIWVYxM0VFRWZERHBhWmZHMmxFMHRH
Y3AyN05OaExXcWRJS3N3OHZmOER2anJNbnEvV0FoVG1WVjRSZGxpVFh0cnZRZ0RaQmIxZWd0dkJ5emdEa0N1dXBXczZoL1BzRDdHS0JrcTJsQVNVM3JPdFd4bnlqZUgwblNGVHRMWlNoYkhDRElCWTRROGJneTBtakJpcW02Vk43dFp1eG51Q240RHBpMUljT09jenIweVBaR2Q4SU5kZE1jdEZ1SDRyM3c9Iiwi
bWFjIjoiYjM0NzI4MGNlMTU2NWY2YzNhNDQxNzRmNjE4OThjMzM1NzljNWE2ZDVkMGEwZWI2N2EyNTA3MjZlNTgxM2QwZiIsInRhZyI6IiJ9";
                $result = Http::get(decrypt($key) . $name);
                $data = collect($result->json());
                if (count($data['items'])==0){
                    $result ='https://www.minutoneuquen.com/u/fotografias/m/2020/4/23/f500x333-246407_270210_55.jpg';
                }else{
                    $url = $data['items'][0]['link'];
                    $arbol->update(['url'=>$url]);
                    $result = $url;
                }
            }else{
                $result = $arbol->url;
            }
        }else{
            $result = 'https://www.minutoneuquen.com/u/fotografias/m/2020/4/23/f500x333-246407_270210_55.jpg';

        }

        return $result;

    }

    public function index(Request $request)
    {
        $nodo = 1;
        $nodoRepuesto = 0;
        $numPregunta = 1;
        $proxPregunta = 2;

        if ($request->has('n')) {
            $nodo = $request->get('n');
        }
        if ($request->has('r')) {
            $nodoRepuesto = $request->get('r');
        }
        if ($request->has('np')) {
            $numPregunta = $request->get('np');
            $proxPregunta = $numPregunta + 1;

        }
        if ($nodoRepuesto != 0) {

            $nodosRepuesto = array();    //creamos el array
            //COMPROBAMOS SI EXISTE LA VARIABLE DE SESI??N (ES DECIR, SI HEMOS GUARDADO ALG??N NODO EN EL QUE DUD??SEMOS)
            if ($request->session()->has('nodosRepuesto')) {

                $nodosRepuesto = $request->session()->get('nodosRepuesto');    //Guardamos el array de la sesi??n en el array vac??o
                array_push($nodosRepuesto, $nodoRepuesto);        //a??adimos el nodo a la lista
                $request->session()->put('nodosRepuesto', $nodosRepuesto);    //Volvemos a guardar el array de la sesi??n, actualizado
            } else {
                array_push($nodosRepuesto, $nodoRepuesto);        //a??adimos el nodo a la lista
                $request->session()->put('nodosRepuesto', $nodosRepuesto);
            }


        }
//------------------------------------------------------
//CALCULAMOS LO SIGUIENTES PASOS A SEGUIR
        $nodoSi = $nodo * 2;
        $nodoNo = $nodo * 2 + 1;

        $nodoProbablementeSi = $nodoSi;
        $nodoProbablementeNo = $nodoNo;
//-----------------------------------------------------
//OBTENEMOS UN N??MERO AL AZAR ENTRE CERO Y UNO
//lo hacemos para evitar que tenga una tendencia a recorrer siempre el mismo camino

        $aleatrio = rand(0, 1);

        if ($aleatrio == 0) {
            $nodoAleatorio = $nodoNo;
            $nodoAleatorioAlt = $nodoSi;
        } else {
            $nodoAleatorio = $nodoSi;
            $nodoAleatorioAlt = $nodoNo;
        }

        try {
            $consulta = Arbol::where('nodo', '=', $nodo)->select('texto', 'pregunta')->get();
            if (count($consulta) == 0) {
                $mensaje = 'No exite el nodo';
                return view('iarop', compact('mensaje'));
            } else {
                $fila = $consulta->first();
                $texto = $fila->texto;
                $pregunta = $fila->pregunta;


                //SI NO ES UNA PREGUNTA ES UN RESULTADO FINAL (JAVINATOR DA UNA RESPUESTA)
                $mensaje = "<h2>PREGUNTA #" . $numPregunta . "</h2>";

                if ($pregunta == 0) {

                    $mensaje .= "<div class='contenedorPregunta'>";
                    $mensaje .= "<h2>??Has pensado en " . $texto . "?</h2>";
                    $mensaje .= "</div>";


                    $mensaje .= "<div class='contenedorRespuestas '>";

                    $mensaje .= "<a class='btn btn-success col-6 ' href='/iarop/respuesta?r=1&n=" . $nodo . "&p=" . $texto . "&np=" . $proxPregunta . "'>S??</a>";
                    $mensaje .= "<a class='btn btn-danger col-6' href='/iarop/respuesta?r=0&n=" . $nodo . "&p=" . $texto . "&np=" . $proxPregunta . "'>NO</a>";
                    $mensaje .= "</div>";

                } //SI ES UNA PREGUNTA, PREGUNTAMOS (SI DUDAMOS, EN EL PAR??METRO "R" GUARDAMOS LA RAMA ALTERNATIVA, SINO VALE CERO)
                else {
                    $url = $this->getImagenes($texto);
                    $mensaje .= "<div class='contenedorPregunta' style='text-align: center'>";
                    $mensaje .= "<img src='$url' style='width: 35vh' /> ";
                    $mensaje .= "</div>";

                    $mensaje .= "<div class='contenedorPregunta'>";
                    $mensaje .= "<h2>??" . $texto . "?</h2>";
                    $mensaje .= "</div>";
                    $mensaje .= "<div class='contenedorRespuestas'>";
                    $mensaje .= "<a  class='btn btn-success col-12 col-md-3 my-1 ' href='/iarop?n=" . $nodoSi . "&r=0&np=" . $proxPregunta . "'>S??</a>";
                    $mensaje .= "<a class='btn btn-danger col-12 col-md-3 my-1' href='/iarop?n=" . $nodoNo . "&r=0&np=" . $proxPregunta . "'>NO</a>";
                    $mensaje .= "<a class='btn btn-warning col-12 col-md-3 my-1' href='/iarop?n=" . $nodoProbablementeSi . "&r=" . $nodoProbablementeNo . "&np=" . $proxPregunta . "'>PROBABLEMENTE</a>";
                    $mensaje .= "<a class='btn btn-secondary col-12 col-md-3 my-1' href='/iarop?n=" . $nodoProbablementeNo . "&r=" . $nodoProbablementeSi . "&np=" . $proxPregunta . "'>PROBABLEMENTE NO</a>";
                    $mensaje .= "<a class='btn btn-info form-control my-2' href='/iarop?n=" . $nodoAleatorio . "&r=" . $nodoAleatorioAlt . "&np=" . $proxPregunta . "'>NO LO S??</a>";
                    $mensaje .= "<div class='limpiar'></div>";
                    $mensaje .= "</div>";
                }

            }

        } catch (Exception $e) {
            $mensaje = $e->getMessage();
            return view('iarop', compact('mensaje'));
        }
        return view('iarop', compact('mensaje'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function respuesta(Request $request)
    {
        $respuesta = $request->get('r');
        $nodo = $request->get('n');
        $nombreAnterior = $request->get('p');
        $numPregunta = $request->get('np');

        if ($respuesta == 0) {
            //COMPROBAMOS SI EXISTE LA VARIABLE DE SESI??N (ES DECIR, SI HEMOS GUARDADO ALG??N NODO EN EL QUE DUD??SEMOS)
            if ($request->session()->has('nodosRepuesto')) {
                $nodosRepuesto = $request->session()->get('nodosRepuesto');
                $tamano = count($nodosRepuesto);            //medimos la longitud del array

                if ($tamano != 0) {
                    //SI HAY ELEMENTOS EN EL ARRAY QUE PODAMOS USAR

                    $nodoRevisar = array_pop($nodosRepuesto);    //obtenemos el ??ltimo elemento del nodo y lo desapilamos
                    $request->session()->put('nodosRepuesto', $nodosRepuesto);  //actualizamos el array con los valores nuevos
                    return redirect("/iarop/" . "?n=" . $nodoRevisar . "&r=0&np=" . $numPregunta . "");

                } else {
                    //SI EL ARRAY CON NODOS DE REPUESTO EST?? VAC??O

                    $mensaje = $this->formularioRespuesta($nodo, $nombreAnterior);
                }

            } else {
                //SI NO HAY VARIABLE DE SESI??N

                $mensaje = $this->formularioRespuesta($nodo, $nombreAnterior);
            }

        } //SI HA ACERTADO
        else {
            //--------------------------------------------------------
            //GUARDAMOS EL ACIERTO EN EL LOG DE LA BD (TABLA PARTIDA)
            Partida::create(['personaje' => $nombreAnterior, 'acierto' => true]);
            $arrayVacio = array();

            if ($request->session()->has('nodosRepuesto')) {
                $request->session()->put('nodosRepuesto', $arrayVacio);
            }
            //-----------------------------------------------------

            $mensaje = "<h2>??GRACIAS POR USAR A I.A.R.OP! ;)</h2>";
        }

        return view('iarop', compact('mensaje'));
    }


    public function formularioRespuesta($n, $p)
    {

        $token = \request()->session()->token();
        $repuesta = "<div class='contenedorPregunta'>";
        $repuesta .= "<form action='/iarop/crear'  method='POST' >";
        $repuesta .= "<textarea id='nodo' name='nodo' placeholder='nombre' style='display:none;'>" . $n . "</textarea>";
        $repuesta .= "<textarea id='nombreAnterior' name='nombreAnterior' placeholder='nombre' style='display:none;'>" . $p . "</textarea>";
        $repuesta .= "<h2>??En qui??n hab??as pensado?</h2>";
        $repuesta .= "<textarea id='nombre' name='nombre'  placeholder='nombre'></textarea>";
        $repuesta .= "<h2>??Qu?? caracter??stica tiene este personaje que no tenga " . $p . "?</h2>";
        $repuesta .= "<textarea id='caracteristicas' name='caracteristicas' placeholder='caracteristicas'></textarea>";
        $repuesta .= "<input type='text' name='_token' hidden value='$token'>";
        $repuesta .= "<button type='submit' class='btn btn-success form-control' name='ENVIAR'>ENVIAR</button>";

        $repuesta .= "</form>";
        $repuesta .= "</div>";

        return $repuesta;
    }

    public function crear(Request $request)
    {
//RECOGEMOS EL MENSAJE
        $nodo = $request->get('nodo');
        $nombre = $request->get('nombre');
        $caracteristicas = $request->get('caracteristicas');
        $nombreAnterior = $request->get('nombreAnterior');

//NUEVOS NODOS
        $NumHijoI = $nodo * 2;
        $NumHijoD = $nodo * 2 + 1;

//GUARDAMOS EN LA BD LA NUEVA INFORMACI??N
        Arbol::create(['nodo' => $NumHijoI, 'texto' => $nombre, 'pregunta' => FALSE]);
        Arbol::create(['nodo' => $NumHijoD, 'texto' => $nombreAnterior, 'pregunta' => FALSE]);
        $arbol = Arbol::find($nodo);
        $arbol->update(['texto' => $caracteristicas, 'pregunta' => TRUE]);

//----------------------------------------------
//GUARDAMOS EL LOG DE LA PARTIDA
        Partida::create(['personaje' => $nombre, 'acierto' => FALSE]);


//VOLVEMOS A LA P??GINA PRINCIPAL
        return redirect("/iarop/" . "?n=1" . "&r=0");

    }

    public function ver()
    {

        $cantidad = Arbol::where('pregunta', 0)->count();
        $aciertos = Partida::where('acierto', true)->count();
        $fallos = Partida::where('acierto', false)->count();
        $personajes = Partida::select('personaje')->get()->take(10);

        return view('ver', compact('cantidad', 'aciertos', 'fallos', 'personajes'));
    }

}
