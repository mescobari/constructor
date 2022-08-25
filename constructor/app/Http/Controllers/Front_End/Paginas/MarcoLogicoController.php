<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\marco_logico\Resultado;
use App\Models\FrontEnd\marco_logico\FrecuenciaMedicion;
use App\Models\FrontEnd\marco_logico\UnidadMedida;

class MarcoLogicoController extends Controller
{    
    public function inicio()
    {
        return view('front-end.paginas.IndexMarcoLogico');
    }

    public function componente_marco_logico($id){
        $tipos_objetvos = Objetivo::where('intervenciones_id', $id)->where('objetivetype_id', 3)->get();        
        return $tipos_objetvos;
    }

    public function producto_marco_logico($id){
        $tipos_objetvos = Resultado::where('objetivos_id', $id)->get();        
        return $tipos_objetvos;
    }

    public function actividad_marco_logico($id){
        $tipos_objetvos = Objetivo::where('intervenciones_id', $id)->where('objetivetype_id', 4)->get();        
        return $tipos_objetvos;
    }

    public function tarea_marco_logico($id){
        $tipos_objetvos = Objetivo::where('intervenciones_id', $id)->where('objetivetype_id', 5)->get();        
        return $tipos_objetvos;
    }

    public function frecuencia_medicion(){
        $frecuencia_mediociones = FrecuenciaMedicion::all();        
        return $frecuencia_mediociones;
    }

    public function unidad_medida(){
        $unidades_medida = UnidadMedida::all();        
        return $unidades_medida;
    }

    public function buscar_arbol_marco_logico(Request $request){
        // $objetivos = Objetivo::whereIn('intervenciones_id', $request)->get();//seria para multiuples proyectos pero eso no va
        $objetivos = Objetivo::where('intervenciones_id', $request->id)->where('gestion',null)->get();
        $padres = Objetivo::where('intervenciones_id', $request->id)->where('padre', 0)->get();
        $procesado = [];
        foreach($padres as $padre){
            $procesado = [array_merge($padre->toArray(), ['dependientes' => $this->busca_hijos($objetivos, $padre)])];
        }
        return $procesado;
    }

    public function busca_hijos($objetivos, $objetivo_padre){
        $hijos = [];
        $hijo = [];
        foreach($objetivos as $objetivo){
            if($objetivo_padre['id'] == $objetivo['padre']){
                $hijo = array_merge($objetivo->toArray(), ['dependientes' => $this->busca_hijos($objetivos, $objetivo)]);
                array_push($hijos, $hijo);
            }         
        }
        return $hijos;
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
        //
    }
}
