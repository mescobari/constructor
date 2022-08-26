<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\marco_logico\Resultado;
use App\Models\FrontEnd\marco_logico\ObjetivoResultado;
use App\Models\FrontEnd\poa\Multigestion;
use App\Models\FrontEnd\intervenciones\Intervencion;

class FormulacionPOAController extends Controller
{
    public function inicio()
    {
        return view('front-end.paginas.IndexFormulacionPoa');
    }
    public function index()
    {
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
    public function generar_poa(Request $request){
        $componentes = Objetivo::whereIn('id', $request->ids)->get();
        foreach($componentes as $componente){
            $resultado = Objetivo::create([
                'intervenciones_id' => $componente->intervenciones_id,
                'objetivetype_id' => $componente->objetivetype_id,
                'padre' => $componente->padre,
                'gestion' => $request->gestion['nombre'],
                'desc_corta' => $componente->desc_corta,
                'fecha_inicial_programada' => $componente->fecha_inicial_programada,
                'fecha_final_programada' => $componente->fecha_final_programada,
                'duracion_dias' => $componente->duracion_dias,
                'monto' => $componente->monto,
                'tipo_ejecucion' => $componente->tipo_ejecucion,
                'descripcion' => $componente->descripcion,
            ]);
            if(isset($resultado->id)){
                $resultado2 = Multigestion::create([
                    'intervenciones_id' => $componente->intervenciones_id,
                    'gestion' => $request->gestion['nombre'],
                    // 'continuidad' => 
                    'mml_id' => $componente->id,
                    'poa_id' => $resultado->id,
                ]);
            }
        }
        $componentes = $componentes = Objetivo::where('gestion',$request->gestion['nombre'])->where('objetivetype_id', 3)->get();
        return $componentes;
    }
    public function gestiones_poa_de_intervencion(){
        $gestiones = Intervencion::orderBy('fecha_inicial_programada','asc')->first();        
        return $gestiones;
    }
    public function gestiones_poa(Request $request){
        // return $request->proyectos['id'];
        $gestiones = Objetivo::select('gestion')->where('objetivetype_id', 3)->where('intervenciones_id', $request->proyectos['id'])->where('gestion', '<>', null)->distinct('gestion')->orderBy('gestion', 'desc')->get();
        return $gestiones;
    }
    public function objetivos_poa($id){
        $ids = Multigestion::where('intervenciones_id', $id)->pluck('mml_id');
        $componentes = Objetivo::where('objetivetype_id', 3)->where('intervenciones_id', $id)->whereNotIn('id', $ids)->where('gestion', null)->get();
        return $componentes;
    }
    public function buscar_arbol_marco_logico_poa(Request $request){
        // return $request->ids;
        $objetivos = Objetivo::all();
        $padres = Objetivo::where('gestion', $request->gestion['nombre'])->where('objetivetype_id', 3)->where('intervenciones_id', $request->id_intervencion)->get();
        // return $padres;
        $procesado = [];
        foreach($padres as $padre){
            array_push($procesado, array_merge($padre->toArray(), ['dependientes' => $this->busca_hijos($objetivos, $padre)]));
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
    public function objetivos_nuevos_continuidad(Request $request){
        $resultado = null;
        if($request->tipo == "nuevo"){
            $objetivo_padre_mml = Multigestion::where('poa_id', $request->id)->first();
            $objetivos = Objetivo::where('padre', $objetivo_padre_mml->mml_id)->get();
            $resultado = $objetivos;
        }else{
            if($request->tipo == "continuidad"){
                $objetivos = Objetivo::where('objetivetype_id',$request->tipo_objetivo)->where('gestion', $request->gestion)->get();
                $resultado = $objetivos;
            }
        }
        return $resultado;
    }

    public function guardar_objetivos(Request $request){
        $fecha_inicio = date("Y-m-d",strtotime($request->fecha_inicio));
        $fecha_fin = date("Y-m-d",strtotime($request->fecha_fin));
        $resultadoObjetivo = Objetivo::create([
            'intervenciones_id' => $request->proyectos['id'],
            'objetivetype_id' => $request->objetivo['id'],
            'padre' => $request->objetivo['padre'],
            'gestion' => $request->gestion,
            'desc_corta' => $request->descripcion_corta_objetivo,
            'fecha_inicial_programada' => $fecha_inicio,
            'fecha_final_programada' => $fecha_fin,
            'descripcion' => $request->resumen_narrativo_objetivo,
            'duracion_dias' => $request->duracion_dias,
            'monto' => $request->monto_bs,
            'tipo_ejecucion' => $request->tipo_ejecucion['valor'],
        ]);        
        $resultadoResultado = Resultado::create([
            'objetivos_id' => $resultadoObjetivo->id,
            'desc_corta' => $request->descripcion_corta_resultado,
            'descripcion' => $request->resumen_narrativo_resultado,
        ]);
        $resultado = ObjetivoResultado::create([
            'objetivos_id' => $resultadoObjetivo->id,
            'resultados_id' => $resultadoResultado->id
        ]);
        
        if(isset($resultadoObjetivo->id)){
            $resultado2 = Multigestion::create([
                'intervenciones_id' => $request->proyectos['id'],
                'gestion' => $request->gestion,
                'continuidad' => $request->estado_nuevo_continuidad,
                'mml_id' => $request->objetivo_nuevo_continuidad['id'],
                'poa_id' => $resultadoObjetivo->id,
            ]);
        }
        return $resultado;
    }
}
