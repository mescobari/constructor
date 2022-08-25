<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use App\Models\BackEnd\intervenciones\ClaInstitucional;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;
use App\Models\FrontEnd\cofinanciadores\ClaOrganismos;
use App\Models\FrontEnd\cofinanciadores\CofinanciadorDocumento;
use App\Models\FrontEnd\cofinanciadores\DocModulo;
use App\Models\FrontEnd\cofinanciadores\TipoDocumento;
use App\Models\FrontEnd\marco_logico\Objetivo;

class CofinanciadoresController extends Controller
{
    
    public function inicio()
    {
        return view('front-end.paginas.IndexCofinanciador');
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {        
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $institucion_id = User::where('id', auth()->user()->id)->with('datos')->first();
        $nombre_carpeta = $institucion_id->datos->institucion_id . "/" . $request->id_proyecto . "/cofinanciadores";
        $files = "";
        if($request->hasFile('files')){
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            // $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo         
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = $request->titulo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            $nombre_archivo = $request->id_proyecto . '_' . $request->id_tipo_documento . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }                
        //cofinanciador
        $cofinanciador = Cofinanciador::create([
            // 'id'=>$request->,//defaut
            'intervenciones_id'=>$request->id_proyecto,
            'institucion_id'=>$request->id_intitucion,
            'organismo_id'=>$request->id_organismo,
        ]);
        $objetivo = Objetivo::where('intervenciones_id', $request->id_proyecto)->where('objetivetype_id', 2)->first();        
        // return $cofinanciador->id;
        //CofinanciadorDocumento
        $tipo_documeto_save = CofinanciadorDocumento::create([
            // 'id'=>$request->,//defaut
            'cofinanciadores_id'=>$cofinanciador->id,
            'document_type_id'=>$request->id_tipo_documento,
            'titulo'=>$request->titulo, 
            'objeto'=>$request->objeto,
            'fecha_firma'=>date('Y-m-d', strtotime($request->id_fecha_firma)),
            'fecha_vencimiento'=>date('Y-m-d', strtotime($request->id_fecha_vencimiento)),
            'duracion_dias'=>$request->duracion_dias,
            'monto_bs'=>$request->monto_bs,
            'monto_Sus'=>$request->monto_Sus,
            'padre'=>'0',
            'pathDocumento'=>$files,
            'objetivos_id'=>$objetivo->id,
            'firma'=>" ",
        ]);

        return $tipo_documeto_save;
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

    }

    public function cofinanciadores_mod(Request $request){        
        $cofinanciador = Cofinanciador::findOrFail($request->id);
        $cofinanciador_documento = CofinanciadorDocumento::findOrFail($request->id_cofinanciador);
             
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $institucion_id = User::where('id', auth()->user()->id)->with('datos')->first();
        
        $nombre_carpeta = $institucion_id->datos->institucion_id . "/" . $request->id_proyecto . "/cofinanciadores";
        $files = "";
        if($request->hasFile('files')){        
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = $request->titulo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            $nombre_archivo = $request->id_proyecto . '_' . $request->id_tipo_documento . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }else{
            $files = $request->pathDocumento;
        }              
        //cofinanciador
        $cofinanciador->update([
            'intervenciones_id'=>$request->id_proyecto,
            'institucion_id'=>$request->id_intitucion,
            'organismo_id'=>$request->id_organismo,
        ]);
        //CofinanciadorDocumento
        $cofinanciador_documento->update([
            'cofinanciadores_id'=>$cofinanciador->id,
            'document_type_id'=>$request->id_tipo_documento,
            'titulo'=>$request->titulo, 
            'objeto'=>$request->objeto,
            'fecha_firma'=>date('Y-m-d', strtotime($request->id_fecha_firma)),
            'fecha_vencimiento'=>date('Y-m-d', strtotime($request->id_fecha_vencimiento)),
            'duracion_dias'=>$request->duracion_dias,
            'monto_bs'=>$request->monto_bs,
            'monto_Sus'=>$request->monto_Sus,
            'padre'=>'0',
            'pathDocumento'=>$files,
        ]);
        return $cofinanciador;
    }

    public function destroy($id)
    {
        $cofinanciador = Cofinanciador::where('id', $id)->first();
        $cofinanciador_documento = CofinanciadorDocumento::where('cofinanciadores_id', $id)->first();
        $cofinanciador_documento->delete();
        $cofinanciador->delete();
        return "Eliminado correctamente";
    }
    public function buscar_cofinanciadores(Request $request){
        $cofinanciadores = Cofinanciador::where('intervenciones_id', $request->intervencion['id'])->with('cofinanciador_documento', 'institucion', 'organismo')->get();        
        foreach($cofinanciadores as $cofinanciador){
            if(isset($cofinanciador->cofinanciador_documento['pathDocumento'])){
                $cofinanciador['filePathFull'] = $request->getSchemeAndHttpHost() . '/' . $cofinanciador->cofinanciador_documento['pathDocumento'];
            }else{
                $cofinanciador['filePathFull'] = "";                                
            }
        }
        return $cofinanciadores;
    }
}
