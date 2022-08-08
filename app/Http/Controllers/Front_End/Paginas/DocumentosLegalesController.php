<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\cofinanciadores\CofinanciadorDocumento;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;
use App\Models\FrontEnd\cofinanciadores\TipoDocumento;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\FrontEnd\cofinanciadores\ClaOrganismos;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\User;
use App\Models\FrontEnd\intervenciones\Intervencion;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DocumentosLegalesController extends Controller
{
    public function inicio()
    {
        return view('front-end.paginas.IndexDocumentosLegales');
    }
    public function index()
    {

    }

    public function store(Request $request)
    {
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $institucion_id = User::where('id', auth()->user()->id)->with('datos')->first();
        //$nombre_carpeta = $institucion_id->datos->institucion_id . "/" . $request->id_proyecto . "/constructor";
        $nombre_carpeta = "/constructor";
        $files = "";
        if($request->hasFile('files')){
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            // $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo
            $extension = $request->file('files')->getClientOriginalExtension();
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = $request->titulo;
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);
            $name = $request->file('file')->getClientOriginalName();
            //$nombre_archivo = $request->id_proyecto . '_' . $request->id_tipo_documento . '_' . trim($titulo) . '.' . $extencion;
            $nombre_archivo =  $name . '.' . $extension;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }
        //cofinanciador
        $cofinanciador = Cofinanciador::create([
            // 'id'=>$request->,//defaut
            'intervenciones_id'=>$request->id_proyecto,
            'institucion_id'=>$request->id_intitucion,
            'organismo_id'=>$request->id_organismo,
        ]);

        $tipo_documeto_save = CofinanciadorDocumento::create([
            // 'id'=>$request->,//defaut
            'cofinanciadores_id'=>$cofinanciador->id,
            'document_type_id'=>$request->id_tipo_documento,
            'objetivos_id'=>$request->id_objetivo,
            'titulo'=>$request->titulo,
            'objeto'=>$request->objeto,
            'modifica'=>$request->modifica,
            'fecha_firma'=>date('Y-m-d', strtotime($request->id_fecha_firma)),
            'fecha_inicio'=>date('Y-m-d', strtotime($request->id_fecha_inicio)),
            'fecha_vencimiento'=>date('Y-m-d', strtotime($request->id_fecha_vencimiento)),
            'duracion_dias'=>$request->duracion_dias,
            'monto_bs'=>$request->monto_bs,
            'monto_Sus'=>$request->monto_Sus,
            'padre'=>$request->id_padre,
            'firma'=>$request->funcionario,
            'pathDocumento'=>$files,
        ]);

        return $tipo_documeto_save;
    }
    public function documentos_legaleses_mod(Request $request){
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
        $cofinanciador_documento = CofinanciadorDocumento::find($request->id_doc_legal);
        if($files==""){
            $files = $cofinanciador_documento->pathDocumento;
        }
        $cofinanciador_documento->update([
            // 'cofinanciadores_id'=>$cofinanciador->id,
            'document_type_id'=>$request->id_tipo_documento,
            'objetivos_id'=>$request->id_objetivo,
            'titulo'=>$request->titulo,
            'objeto'=>$request->objeto,
            'modifica'=>$request->modifica,
            'fecha_firma'=>date('Y-m-d', strtotime($request->id_fecha_firma)),
            'fecha_inicio'=>date('Y-m-d', strtotime($request->id_fecha_inicio)),
            'fecha_vencimiento'=>date('Y-m-d', strtotime($request->id_fecha_vencimiento)),
            'duracion_dias'=>$request->duracion_dias,
            'monto_bs'=>$request->monto_bs,
            'monto_Sus'=>$request->monto_Sus,
            'padre'=>$request->id_padre,
            'firma'=>$request->funcionario,
            'pathDocumento'=>$files,
        ]);
        $cofinanciador = Cofinanciador::find($cofinanciador_documento->cofinanciadores_id);
        $cofinanciador->update([
            'intervenciones_id'=>$request->id_proyecto,
            'institucion_id'=>$request->id_intitucion,
            'organismo_id'=>$request->id_organismo,
        ]);
        return $cofinanciador_documento;
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

    public function buscar_documentos_legaleses(Request $request){
        $cofinanciador = Cofinanciador::where('intervenciones_id', $request->intervencion['id'])->get();
        $ids = [];
        foreach($cofinanciador as $val){
            $ids = array_merge($ids, [$val->id]);
        }
        $cofinanciadores_docs = CofinanciadorDocumento::whereIn('cofinanciadores_id', $ids)->with('institucion', 'padre', 'tipo_documento', 'objetivo')->get();
        foreach($cofinanciadores_docs as $dat){
            $dat['filePathFull'] = $request->getSchemeAndHttpHost() . '/' . $dat->pathDocumento;
        }
        return $cofinanciadores_docs;
    }
    public function buscar_documentos_legaleses_combo(Request $request){
        $cofinanciador = Cofinanciador::where('intervenciones_id', $request->intervencion['id'])->get();
        $ids = [];
        foreach($cofinanciador as $val){
            $ids = array_merge($ids, [$val->id]);
        }
        $cofinanciadores_docs = CofinanciadorDocumento::whereIn('cofinanciadores_id', $ids)->get();
        return $cofinanciadores_docs;
    }
    public function buscar_documentos_legaleses_tipos_doc(Request $request){
        $retornar = TipoDocumento::get();
        return $retornar;
    }
    public function buscar_documentos_legaleses_instituciones(Request $request){
        $retornar = ClaInstitucional::get();
        return $retornar;
    }
    public function buscar_documentos_legaleses_org_finan(Request $request){
        $retornar = ClaOrganismos::get();
        return $retornar;
    }
    public function buscar_documentos_legaleses_objetivos(Request $request){
        $id = [3,4];
        $retornar = Objetivo::where('intervenciones_id', $request->intervencion['id'])->whereIn('objetivetype_id', $id)->get();
        return $retornar;
    }
    public function reporte($id){
        $intervencion = Intervencion::where('id', $id)->first();
        //qr
        $codgioQR = QrCode::size(50)->generate("holas");
        $pdf = PDF::loadView('front-end.reportes.documentos_legales.pdf.reporte', [
            'QR' => $codgioQR
                                                                                            // 'glosa'=>$glosa,
                                                                                            // 'fecha_registro'=>$fecha_registro,
                                                                                            // 'nombre_proyecto'=>$nombre_proyecto,
                                                                                            // 'moneda'=>$moneda,
                                                                                            // 'componentes'=>$componentes,
                                                                                            // 'doc_asociados'=>$doc_asociados
                                                                                        ]);
        $pdf->setPaper('letter', 'portrait');
        // $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('reporte_estructura_financiamiento.pdf');
        // return  $pdf->download('reporte_estructura_financiamiento.pdf');
    }
}
