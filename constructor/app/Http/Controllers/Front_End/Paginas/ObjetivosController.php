<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\marco_logico\TipoObjetivo;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\marco_logico\Resultado;
use App\Models\FrontEnd\marco_logico\ObjetivoResultado;

class ObjetivosController extends Controller
{    
    public function verTiposObjetivos(){
        $tipos_objetvos = TipoObjetivo::all();        
        return $tipos_objetvos;
    }

    public function verTipoObjetivo($id){
        $tipos_objetvos = TipoObjetivo::where('id', $id)->get();        
        return $tipos_objetvos;
    }

    public function verObjetivosProceso($id){
        $objetivos = Objetivo::where('intervenciones_id', $id)->get();        
        return $objetivos;
    }

    public function verTiposObjetivosHijos($id){//ver los objetivos hijos de un objetivo padre
        $objetivos = TipoObjetivo::where('padre', $id)->get();        
        return $objetivos;
    }

    public function verResultado($id){
        $resultados = Resultado::where('objetivos_id', $id)->get();
        return $resultados;
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        // $fecha_inicio = date("Y-m-d",strtotime($request->fecha_inicio."+ 1 days"));
        // $fecha_fin = date("Y-m-d",strtotime($request->fecha_fin."+ 1 days"));
        $fecha_inicio = date("Y-m-d",strtotime($request->fecha_inicio));
        $fecha_fin = date("Y-m-d",strtotime($request->fecha_fin));
        // return [
        //     $request->proyectos['id'],
        //     $request->objetivo['id'],
        //     $request->objetivo['padre'],
        //     $request->descripcion_corta_objetivo,
        //     $request->fecha_inicio,
        //     $request->fecha_fin,
        //     $fecha,
        //     $request->resumen_narrativo_objetivo,
        //     $request->tipo_ejecucion['valor'],

        //     $request->descripcion_corta_resultado,
        //     $request->resumen_narrativo_resultado,
        // ];
        // return $request;
        // return [$fecha_inicio, $request->fecha_inicio];
        $resultadoObjetivo = Objetivo::create([
            'intervenciones_id' => $request->proyectos['id'],
            'objetivetype_id' => $request->objetivo['id'],
            'padre' => $request->objetivo['padre'],
            // 'gestion' => request,
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
        return $resultado;
    }

    public function updateObjetivo(Request $request){      
        // return $request;  
        // $fecha_inicio = date("Y-m-d",strtotime($request->fecha_inicio."+ 1 days"));
        // $fecha_fin = date("Y-m-d",strtotime($request->fecha_fin."+ 1 days"));
        $objetivo = Objetivo::where('id', $request->id_objetivo_update)->first();
        $objetivo->update([            
            // 'intervenciones_id' => $request->proyectos['id'],
            // 'objetivetype_id' => $request->objetivo['id'],
            // 'padre' => $request->objetivo['padre'],
            // 'gestion' => request,
            'desc_corta' => $request->descripcion_corta_objetivo,
            'fecha_inicial_programada' => date('Y-m-d', strtotime($request->fecha_inicio)),
            'fecha_final_programada' => date('Y-m-d', strtotime($request->fecha_fin)),
            'descripcion' => $request->resumen_narrativo_objetivo,
            'duracion_dias' => $request->duracion_dias,
            'monto' => $request->monto_bs,
            'tipo_ejecucion' => $request->tipo_ejecucion['valor'],
        ]);
        return $objetivo;
    }

    public function storeResultado(Request $request){        
        $resultadoResultado = Resultado::create([
            'objetivos_id' => $request->id_objetivo_update,
            'desc_corta' => $request->descripcion_corta_resultado,
            'descripcion' => $request->resumen_narrativo_resultado,
        ]);
        $resultado = ObjetivoResultado::create([
            'objetivos_id' => $request->id_objetivo_update,
            'resultados_id' => $resultadoResultado->id
        ]);
        return $resultadoResultado;
    }

    public function updateResultado(Request $request){
        $resultado = Resultado::where('id', $request->id_resultado_update)->first();
        $resultado->update([            
            'desc_corta' => $request->descripcion_corta_resultado,
            'descripcion' => $request->resumen_narrativo_resultado,
        ]);
        return $resultado;
    }

    public function deleteResultado($id){
        $resultado = Resultado::find($id);
        $objetivoResultado = ObjetivoResultado::where('resultados_id', $resultado->id)->first();
        $objetivoResultado->delete();
        $resultado->delete();
        return "borrado";
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
