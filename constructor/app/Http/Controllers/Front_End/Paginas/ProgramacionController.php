<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\marco_logico\IndicadorSeguimiento;

class ProgramacionController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $array = [
            'indicador_planificacion_id' => $request->indicador_planificacion_id,
            'fecha' => $request->fecha,
            'gestion' => $request->gestion,
            'move_indicator_type_id' => $request->move_indicator_type_id,
            'concepto' => $request->concepto,
            'valor_medido' => $request->valor_medido,
            'glosa' => $request->glosa,
            'pathDocumento' => $request->pathDocumento,
        ];
        $programaciones = IndicadorSeguimiento::create($array);
        
        return $programaciones;
    }

    public function show($id)
    {
        $programaciones = IndicadorSeguimiento::where('indicador_planificacion_id', $id)->get();
        return $programaciones;
    }

    public function programaciones_mod(Request $request){
        $programaciones = IndicadorSeguimiento::find($request->id);
        // return $programaciones;
        $array = [
            'indicador_planificacion_id' => $request->indicador_planificacion_id,
            'fecha' => $request->fecha,
            'gestion' => $request->gestion,
            'move_indicator_type_id' => $request->move_indicator_type_id,
            'concepto' => $request->concepto,
            'valor_medido' => $request->valor_medido,
            'glosa' => $request->glosa,
            'pathDocumento' => $request->pathDocumento,
        ];
        // return $array;
        $programaciones->update($array);
        return $programaciones;
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
