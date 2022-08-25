<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Localizacion;
use App\Models\FrontEnd\LocalizacionIntervencion;
use App\Models\FrontEnd\LocalizacionTipo;
use App\Models\FrontEnd\intervenciones\Intervencion;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;

class ubicacionesController extends Controller
{
    
    public function inicio()
    {
        return view('front-end.paginas.IndexUbicacion');
    }
    public function index()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {

    }
    public function eliminar_ubicacion(Request $request){
        $ubicacion_borrar = LocalizacionIntervencion::where('localizaciones_id', $request->localizaciones_id)->where('intervenciones_id', $request->intervenciones_id)->first();        
        $ubicacion_borrar->delete();
        return "registro eliminado";
    }

    public function departamentos(){
        $respuesta = Localizacion::where('locationtype_id', 1)->get();
        return $respuesta;
    }
    public function ubicacionesBuscadas(Request $request){
        $usbicacionesSeleccionadas = LocalizacionIntervencion::where('intervenciones_id', $request->proyecto['id'])->get();
        $tipos_localizacion = LocalizacionTipo::orderBy('id', 'desc')->get();
        // $localizacionesFull = Localizacion::all();//se usa si queremos hacer procesos internos sin consultar varias veces a base de datos pero aqui no por que es como 50000 registros o mas es mas pesado trabajar con matrices
        $localizaciones = Localizacion::where( DB::raw('upper(nombre)'), 'LIKE', '%' . strtoupper($request->nombreBuscar) . '%')->orderBy('locationtype_id', 'desc')->get();//locationtype_id
        $respuesta = [];
        if(isset($request->departamento['id'])){
            $id_departamento = $request->departamento['id'];
        }
        foreach($localizaciones as $localizacion){
            $cont = 0;
            $localizacion_x = $localizacion;
            $arregloTodosTiposLocalizaciones = [];
            $perteneceDepartamento = false;//validador de departamentos
            $primerArreglo = [];
            if(!isset($id_departamento)){
                $perteneceDepartamento = true;
            }
            foreach($tipos_localizacion as $tipo_localizacion){
                //lo que vamos a hacer es: preguntas es uno debes buscar 2localizacionesFull,3,4,5 es 2 debes buscar 1,3,4,5 y asi sucesivamente dentro de nuestro full array buscar todas las conincidencias y assignar el nombre que corresponde segun el array
                if($localizacion->locationtype_id == $tipo_localizacion->id){//preguntar si estamos en tipo de localizacion buscado
                    $primerArreglo = ['nombre' . $tipo_localizacion->id => $localizacion->nombre];
                    //verificamos si este registro 1 pertenece al departamento buscado
                    if(isset($id_departamento)){
                        if(1 == $localizacion->locationtype_id){
                            if($id_departamento == $localizacion->id){
                                $perteneceDepartamento = true;
                            }                            
                        }
                    }
                }
                if(empty($primerArreglo)){//si esta vacio entonces aun no encontramos la igualdad de localizacion por lo que tenemos el nivel superior pero no el inferior, en todo caso asignaremos valor nulo                    
                    $array_aux = ['nombre' . $tipo_localizacion->id => "-"];
                    $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                }else{//si no esta vacio entonces quiere decir que ya tenemos un vector con el valor inicial                    
                    if($cont == 0){//es la primera vez que hay valores en el vector                        
                        $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $primerArreglo);
                    }else{//no es la primera vez es la x veces
                        //entonces lo que debemos hacer es buscar el id de padre con respecto a el $primerArreglo y asignarle el valor obtenido a $primerArreglo tal como fue la primera vez
                        $cont_aux = 0;

                        if(!isset($localizacion_x->padre)){
                            return "falta un id de padre ... la integridad de la base de datos se encuentra comprometida";
                        }
                        $localizacion_aux = Localizacion::where('id', $localizacion_x->padre)->first();
                        if(isset($localizacion_aux->nombre)){
                            $localizacion_x = $localizacion_aux;
                            $array_aux = ['nombre' . $tipo_localizacion->id => $localizacion_x->nombre];
                            $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                            $cont_aux++;
                            //verificamos si este registro x pertenece al departamento buscado
                            if(isset($id_departamento)){
                                if(1 == $localizacion_x->locationtype_id){
                                    if($id_departamento == $localizacion_x->id){
                                        $perteneceDepartamento = true;
                                    }                            
                                }
                            }
                        } 
                        /**************codigo para buscar sin muchas consultas a base de datos pero por la cantidad de data se hace mas pesado que consultar varias veces a base de datos (jalara muchos recursos de servidor y tardara)************/
                        // foreach($localizacionesFull as $localizacion_aux){
                            
                        //     if($localizacion_x->padre == $localizacion_aux->id){//encontramos el padre ya que no es la primera vez que entramos al else anterior
                        //         // return $localizacion_aux;
                        //         $localizacion_x = $localizacion_aux;
                        //         $array_aux = ['nombre' . $tipo_localizacion->id => $localizacion_x->nombre];
                                
                        //         $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                        //         $cont_aux++;
                        //     }
                        // }
                        // if($cont_aux == 0){ !!!!!!!!!falta validdr departamentos hay que fijarse de mas arriba
                        //     $array_aux = ['nombre' . $tipo_localizacion->id => "-"];
                        //     $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                        // }
                    }
                    $cont++;
                }
            }
            if($perteneceDepartamento == true){//validador de departamentos
                $perteneceAlProyecto = false;
                foreach($usbicacionesSeleccionadas as $ubicacionSeleccionada){
                    if($ubicacionSeleccionada->localizaciones_id == $localizacion->id){
                        $perteneceAlProyecto = true;
                    }
                }
                // $respuesta = $localizaciones;
                $checke = 0;
                if($perteneceAlProyecto == true){
                    $checke = 1;
                }else{
                    $checke = 0;
                }
                $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, ['estado_check'=>$checke]);
                $respuesta_aux = array_merge($localizacion->toArray(), $arregloTodosTiposLocalizaciones);
                array_push($respuesta, $respuesta_aux);
            }
        }

        $respuesta2 = [];
        $id_localizaciones_seleccionadas = [];
        foreach($usbicacionesSeleccionadas as $usbicacioneSeleccionada){
            $id_localizaciones_seleccionadas = array_merge($id_localizaciones_seleccionadas, [$usbicacioneSeleccionada->localizaciones_id]);
        }
        $localizaciones_seleccionadas = Localizacion::whereIn('id', $id_localizaciones_seleccionadas)->get();
        foreach($localizaciones_seleccionadas as $localizacion){
            $cont = 0;
            $localizacion_x = $localizacion;
            $arregloTodosTiposLocalizaciones = [];
            $primerArreglo = [];

            $perteneceDepartamento = true;

            foreach($tipos_localizacion as $tipo_localizacion){
                //lo que vamos a hacer es: preguntas es uno debes buscar 2localizacionesFull,3,4,5 es 2 debes buscar 1,3,4,5 y asi sucesivamente dentro de nuestro full array buscar todas las conincidencias y assignar el nombre que corresponde segun el array
                if($localizacion->locationtype_id == $tipo_localizacion->id){//preguntar si estamos en tipo de localizacion buscado
                    $primerArreglo = ['nombre' . $tipo_localizacion->id => $localizacion->nombre];
                    
                }
                if(empty($primerArreglo)){//si esta vacio entonces aun no encontramos la igualdad de localizacion por lo que tenemos el nivel superior pero no el inferior, en todo caso asignaremos valor nulo                    
                    $array_aux = ['nombre' . $tipo_localizacion->id => "-"];
                    $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                }else{//si no esta vacio entonces quiere decir que ya tenemos un vector con el valor inicial                    
                    if($cont == 0){//es la primera vez que hay valores en el vector                        
                        $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $primerArreglo);
                    }else{//no es la primera vez es la x veces
                        //entonces lo que debemos hacer es buscar el id de padre con respecto a el $primerArreglo y asignarle el valor obtenido a $primerArreglo tal como fue la primera vez
                        $cont_aux = 0;

                        if(!isset($localizacion_x->padre)){
                            return "falta un id de padre ... la integridad de la base de datos se encuentra comprometida";
                        }
                        $localizacion_aux = Localizacion::where('id', $localizacion_x->padre)->first();
                        if(isset($localizacion_aux->nombre)){
                            $localizacion_x = $localizacion_aux;
                            $array_aux = ['nombre' . $tipo_localizacion->id => $localizacion_x->nombre];
                            $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                            $cont_aux++;
                            
                        } 
                    }
                    $cont++;
                }
            }
            if($perteneceDepartamento == true){//validador de departamentos
                $perteneceAlProyecto = false;
                foreach($usbicacionesSeleccionadas as $ubicacionSeleccionada){
                    if($ubicacionSeleccionada->localizaciones_id == $localizacion->id){
                        $perteneceAlProyecto = true;
                    }
                }
                // $respuesta = $localizaciones;
                $checke = 0;
                if($perteneceAlProyecto == true){
                    $checke = 1;
                }else{
                    $checke = 0;
                }
                $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, ['estado_check'=>$checke]);
                $respuesta_aux = array_merge($localizacion->toArray(), $arregloTodosTiposLocalizaciones);
                array_push($respuesta2, $respuesta_aux);
            }
        }

        $respuesta = ['usbicacionesSeleccionadas' => $respuesta2, 'respuesta' => $respuesta];
        return $respuesta;
    }
    
    public function GuardarUbicaciones(Request $request){
        if(!isset($request->localizaciones_id)){
            return "no existen datos favor de realizar selecciones";
        }
        // $ubicaciones_borrar = LocalizacionIntervencion::where('intervenciones_id', $request->intervencion['id'])->get();
        // foreach($ubicaciones_borrar as $ubicacione_borrar){
        //     $ubicacione_borrar->delete();
        // }
        $ubicaciones = $request->localizaciones_id;
        foreach($ubicaciones as $id_ubicacion){
            $registros = LocalizacionIntervencion::where('localizaciones_id', $id_ubicacion)
                                                    ->where('intervenciones_id', $request->intervencion['id'])->get();    
            $cont = 0;
            foreach($registros as $registro){
                $cont++;
            }    
            if($cont == 0){
                $resultado = LocalizacionIntervencion::create([
                    'localizaciones_id' => $id_ubicacion,
                    'intervenciones_id' => $request->intervencion['id'],          
                ]);
            }
        }        
        return $resultado;
    }

    public function BuscaUbicacionesRegistradas(Request $request){
        $usbicacionesSeleccionadas = LocalizacionIntervencion::where('intervenciones_id', $request->proyecto['id'])->get();
        $tipos_localizacion = LocalizacionTipo::orderBy('id', 'desc')->get();
        $respuesta2 = [];
        $id_localizaciones_seleccionadas = [];
        foreach($usbicacionesSeleccionadas as $usbicacioneSeleccionada){
            $id_localizaciones_seleccionadas = array_merge($id_localizaciones_seleccionadas, [$usbicacioneSeleccionada->localizaciones_id]);
        }
        $localizaciones_seleccionadas = Localizacion::whereIn('id', $id_localizaciones_seleccionadas)->get();
        foreach($localizaciones_seleccionadas as $localizacion){
            $cont = 0;
            $localizacion_x = $localizacion;
            $arregloTodosTiposLocalizaciones = [];
            $primerArreglo = [];

            $perteneceDepartamento = true;

            foreach($tipos_localizacion as $tipo_localizacion){
                //lo que vamos a hacer es: preguntas es uno debes buscar 2localizacionesFull,3,4,5 es 2 debes buscar 1,3,4,5 y asi sucesivamente dentro de nuestro full array buscar todas las conincidencias y assignar el nombre que corresponde segun el array
                if($localizacion->locationtype_id == $tipo_localizacion->id){//preguntar si estamos en tipo de localizacion buscado
                    $primerArreglo = ['nombre' . $tipo_localizacion->id => $localizacion->nombre];
                    
                }
                if(empty($primerArreglo)){//si esta vacio entonces aun no encontramos la igualdad de localizacion por lo que tenemos el nivel superior pero no el inferior, en todo caso asignaremos valor nulo                    
                    $array_aux = ['nombre' . $tipo_localizacion->id => "-"];
                    $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                }else{//si no esta vacio entonces quiere decir que ya tenemos un vector con el valor inicial                    
                    if($cont == 0){//es la primera vez que hay valores en el vector                        
                        $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $primerArreglo);
                    }else{//no es la primera vez es la x veces
                        //entonces lo que debemos hacer es buscar el id de padre con respecto a el $primerArreglo y asignarle el valor obtenido a $primerArreglo tal como fue la primera vez
                        $cont_aux = 0;

                        if(!isset($localizacion_x->padre)){
                            return "falta un id de padre ... la integridad de la base de datos se encuentra comprometida";
                        }
                        $localizacion_aux = Localizacion::where('id', $localizacion_x->padre)->first();
                        if(isset($localizacion_aux->nombre)){
                            $localizacion_x = $localizacion_aux;
                            $array_aux = ['nombre' . $tipo_localizacion->id => $localizacion_x->nombre];
                            $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                            $cont_aux++;
                            
                        } 
                    }
                    $cont++;
                }
            }
            if($perteneceDepartamento == true){//validador de departamentos
                $perteneceAlProyecto = false;
                foreach($usbicacionesSeleccionadas as $ubicacionSeleccionada){
                    if($ubicacionSeleccionada->localizaciones_id == $localizacion->id){
                        $perteneceAlProyecto = true;
                    }
                }
                // $respuesta = $localizaciones;
                $checke = 0;
                if($perteneceAlProyecto == true){
                    $checke = 1;
                }else{
                    $checke = 0;
                }
                $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, ['estado_check'=>$checke]);
                $respuesta_aux = array_merge($localizacion->toArray(), $arregloTodosTiposLocalizaciones);
                array_push($respuesta2, $respuesta_aux);
            }
        }

        $respuesta = $respuesta2;
        return $respuesta;
    }
}
