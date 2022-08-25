<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\marco_logico\Indicador;
use App\Models\FrontEnd\marco_logico\IndicadorResultado;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\marco_logico\Resultado;
use App\Models\FrontEnd\marco_logico\IndicadorPlanificacion;
use App\Models\FrontEnd\marco_logico\IndicadorSeguimiento;

class IndicadoresController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $indicador = Indicador::create([
            'nombre' => $request->Indicador_nombre,
            'descripcion' => $request->Indicador_descripcion,
            'frecuencia' => $request->Indicador_frecuencia['id'],
            'variables' => $request->Indicador_variables,
            'calculo' => $request->Indicador_calculo,
            'unidades_id' => $request->Indicador_unidades_id['id'],
            'medios_verificacion' => $request->Indicador_medios_verificacion,
        ]);
        $indicador_resultado = IndicadorResultado::create([
            'resultados_id' => $request->resultadoIndicador['id'],
            'indicadores_id'  => $indicador->id,
        ]);
        return $indicador_resultado;
    }

    public function indicador_resultado(Request $request){
        $indicador_resultado = IndicadorResultado::where('resultados_id', $request->id_resultado)->where('indicadores_id', $request->id_indicador)->first();
        return $indicador_resultado;
    }

    public function show($id)
    {
        $indicador_resultado = IndicadorResultado::where('resultados_id', $id)->get();
        $id_indicadores = [];
        foreach($indicador_resultado as $varor){
            $id_indicadores = array_merge($id_indicadores, [$varor->indicadores_id ]);
        }
        $indicadores = Indicador::whereIn('id', $id_indicadores)->with('unidades', 'frecuencias')->get();
        return $indicadores;
    }

    public function update(Request $request, $id)
    {
    }

    public function indicadores_mod(Request $request)
    {
        $indicador = Indicador::where('id', $request->Indicador_id)->first();
        $indicador->update([
            'nombre' => $request->Indicador_nombre,
            'descripcion' => $request->Indicador_descripcion,
            'frecuencia' => $request->Indicador_frecuencia['id'],
            'variables' => $request->Indicador_variables,
            'calculo' => $request->Indicador_calculo,
            'unidades_id' => $request->Indicador_unidades_id['id'],
            'medios_verificacion' => $request->Indicador_medios_verificacion,
        ]);
        return $indicador;        
    }
    
    public function destroy($id)
    {
        $indicador = Indicador::find($id);
        $indicador_resultado = IndicadorResultado::where('indicadores_id', $id)->first();
        $indicador_resultado->delete();
        $indicador->delete();
        return $indicador;
    }
    public function indicadores_seguimiento_fisico(Request $request){//id proyecto, año, 
        $objetivos = Objetivo::where('intervenciones_id', $request->proyectos['id'])->where('gestion', $request->gestion)->get()->pluck('id');
        $resultados = Resultado::whereIn('objetivos_id', $objetivos)->get()->pluck('id');
        $indicador_resultado = IndicadorResultado::whereIn('resultados_id', $resultados)->get()->pluck('id');
        $indicador_planificacion = IndicadorPlanificacion::whereIn('indicadores_resultados_id', $indicador_resultado)->get()->pluck('id');
        $indicador_seguimiento = IndicadorSeguimiento::whereIn('indicador_planificacion_id', $indicador_planificacion)->get();
        return $indicador_seguimiento;
    }
}