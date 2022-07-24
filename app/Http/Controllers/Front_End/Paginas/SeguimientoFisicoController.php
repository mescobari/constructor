<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\poa\Seguimiento\InformeSeguimiento;
use App\Models\FrontEnd\marco_logico\IndicadorSeguimiento;
use App\Models\User;

class SeguimientoFisicoController extends Controller
{
    public function inicio()
    {
        return view('front-end.paginas.IndexSeguimientoFisico');
    }
    public function index()
    {
        // 
    }
    public function store(Request $request)
    {
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $institucion_id = User::where('id', auth()->user()->id)->with('datos')->first();
        $nombre_carpeta = $institucion_id->datos->institucion_id . "/" . $request->id_proyecto . "/estructura_financiamiento";
        $files = "";
        if($request->hasFile('files')){
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo         
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = 'Respaldo_de_informe_' . $nombre_archivo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            // $nombre_archivo = $request->id_intervencion . '_' . trim($titulo);
            $nombre_archivo = $request->id_intervencion . '_' . $request->document_type_id . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }      

        $id_funcionario = new User;
        $id_funcionario = $id_funcionario->funcionario_user_auth()->id;
        $informe_seguimiento = InformeSeguimiento::create([
            'intervenciones_id'=>$request->id_intervencion,
            'move_indicator_type_id'=>$request->move_indicator_type_id,
            'document_type_id'=>$request->document_type_id,
            'gestion'=>$request->gestion,
            // 'fecha'=>$request->id_proyecto,
            // 'referencia'=>$request->id_proyecto,
            'descripcion'=>$request->glosa,
            'funcionarios_id'=>$id_funcionario,
        ]);
        return $informe_seguimiento;
    }
    public function show($id)
    {
        $informe_seguimiento = InformeSeguimiento::where('gestion', $id)->with('tipo_movimiento', 'tipo_documento')->get();
        return $informe_seguimiento;
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
    
    public function storeIndicadorSeguimientoEJ(Request $request)
    {
        $array = [
            'indicador_planificacion_id' => $request->extras['indicador_planificacion_id'],
            'fecha' => $request->extras['fecha'],
            'gestion' => $request->extras['gestion'],
            'move_indicator_type_id' => $request->move_indicator_type_id,
            'concepto' => $request->extras['concepto'],
            'valor_medido' => $request->extras['valor_observado'],
            'glosa' => $request->extras['comentario'],
            'pathDocumento' => $request->extras['pathDocumento'],
            'informe_seguimiento_id' => $request->id_informe_fisico,
        ];
        $programaciones = IndicadorSeguimiento::create($array);
        return $programaciones;
    }
    public function updateIndicadorSeguimientoEJ(Request $request){
        $programaciones = IndicadorSeguimiento::find($request->extras['id']);
        $array = [
            'indicador_planificacion_id' => $request->extras['indicador_planificacion_id'],
            'fecha' => $request->extras['fecha'],
            'gestion' => $request->extras['gestion'],
            'move_indicator_type_id' => $request->move_indicator_type_id,
            'concepto' => $request->extras['concepto'],
            'valor_medido' => $request->extras['valor_medido'],
            'glosa' => $request->extras['glosa'],
            'pathDocumento' => $request->extras['pathDocumento'],
            'informe_seguimiento_id' => $request->id_informe_fisico,
        ];
        $programaciones = $programaciones->update($array);
        return $programaciones;
    }
    public function deleteIndicadorSeguimientoEJ($id){
        $programaciones = IndicadorSeguimiento::find($id);
        $programaciones = $programaciones->delete();
        return $programaciones;
    }
}
