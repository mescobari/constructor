<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\marco_logico\IndicadorPlanificacion;
use App\Models\User;

class PlanificacionesController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $institucion_id = User::where('id', auth()->user()->id)->with('datos')->first();
        $nombre_carpeta = $request->institucion_id . "/" . $request->intervencion_id . "/marco_logico/indicadores/planificaciones";
        $files = "";
        if($request->hasFile('files')){
            $files = $request->file('files')->store('planificaciones/' . $nombre_carpeta);//nombre por default del sistema
                        
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo         
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = 'Respaldo_de_planificacion_' . $nombre_archivo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);
            // $nombre_archivo = $request->id_intervencion . '_' . trim($titulo);
            $nombre_archivo = $request->intervencion_id . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);
        }         
        $planificacion = IndicadorPlanificacion::create([
            'indicadores_resultados_id' => $request->indicadores_resultados_id,
            'gestion' =>$request->Planificacion_gestion,
            'fecha_inicial' =>date('Y-m-d', strtotime($request->id_fecha_inicial)),
            'fecha_final' =>date('Y-m-d', strtotime($request->id_fecha_final)),
            'indicador_frecuencia_id' =>$request->indicador_frecuencia_id,
            'valor_inicial' =>$request->Planificacion_valor_inicial,
            'valor_final' =>$request->Planificacion_valor_final,
            'glosa' =>$request->Planificacion_glosa,
            'pathDocumento' => $files,
        ]);

        return $planificacion;
    }

    public function show($id)
    {        
        $indicadores = IndicadorPlanificacion::where('indicadores_resultados_id', $id)->with('frecuencias')->get();
        return $indicadores;
    }

    public function planificaciones_mod(Request $request){
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $institucion_id = User::where('id', auth()->user()->id)->with('datos')->first();
        $nombre_carpeta = $request->institucion_id . "/" . $request->intervencion_id . "/marco_logico/indicadores/planificaciones";
        $files = "";
        if($request->hasFile('files')){
            $files = $request->file('files')->store('planificaciones/' . $nombre_carpeta);//nombre por default del sistema
                        
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo         
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = 'Respaldo_de_planificacion_' . $nombre_archivo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);
            // $nombre_archivo = $request->id_intervencion . '_' . trim($titulo);
            $nombre_archivo = $request->intervencion_id . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);
        }    
        $planificacion = IndicadorPlanificacion::find($request->Planificacion_id);
        if( $files == "" ){
            $files = $planificacion->pathDocumento;
        }
        $planificacion->update([
            'indicadores_resultados_id' => $request->indicadores_resultados_id,
            'gestion' =>$request->Planificacion_gestion,
            'fecha_inicial' =>date('Y-m-d', strtotime($request->id_fecha_inicial)),
            'fecha_final' =>date('Y-m-d', strtotime($request->id_fecha_final)),
            'indicador_frecuencia_id' =>$request->indicador_frecuencia_id,
            'valor_inicial' =>$request->Planificacion_valor_inicial,
            'valor_final' =>$request->Planificacion_valor_final,
            'glosa' =>$request->Planificacion_glosa,
            'pathDocumento' => $files,
        ]);

        return $planificacion;
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $planificacion = IndicadorPlanificacion::find($id);
        $planificacion->delete();
        return $planificacion;
    }
}
