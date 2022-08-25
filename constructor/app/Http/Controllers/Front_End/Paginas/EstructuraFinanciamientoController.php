<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\estructura_financiamiento\Presupuestario;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;
use App\Models\FrontEnd\estructura_financiamiento\ComprobanteEncabezado;
use App\Models\FrontEnd\estructura_financiamiento\ComprobanteDetalle;
use App\Models\FrontEnd\estructura_financiamiento\TiposMovimientos;
use App\Models\User;
use App\Models\FrontEnd\marco_logico\Objetivo;
use PDF;
use App\Models\FrontEnd\intervenciones\Intervencion;
use App\Models\FrontEnd\financiamiento\CotizacionDolar;
class EstructuraFinanciamientoController extends Controller
{
    public function inicio()
    {
        return view('front-end.paginas.IndexEstructuraFinanciamiento');
    }

    public function tipos_movimientos(){
        $tipos_movimientos = TiposMovimientos::all();
        return $tipos_movimientos;
    }

    public function componenteEF($id){
        $tipos_objetvos = Objetivo::where('intervenciones_id', $id)->where('objetivetype_id', 3)->get();        
        return $tipos_objetvos;
    }

    public function partida(){
        $partidas = Presupuestario::all();
        foreach($partidas as $partida){
            $partida['codigo_nombre'] = $partida->codigo . '-' . $partida->nombre;
        }
        return $partidas;
    }

    public function cofinanciador($id){
        $cofinanciadores = Cofinanciador::where('intervenciones_id', $id)->with('cofinanciador_documento', 'organismo', 'institucion')->get();  
        foreach($cofinanciadores as $cofinanciador){
            $cofinanciador['nombre'] = $cofinanciador->cofinanciador_documento->titulo;
        }      
        return $cofinanciadores;
    }
    public function cofinanciadorEF($id){
        $cofinanciadores = Cofinanciador::where('intervenciones_id', $id)->with('cofinanciador_documento', 'organismo', 'institucion')->get();  
        foreach($cofinanciadores as $cofinanciador){
            $cofinanciador['nombre'] = $cofinanciador->institucion->nombre;
        }      
        return $cofinanciadores;
    }

    public function index()
    {
        
    }

    
    public function store(Request $request)
    {
        
    }

    public function comprobante_detalle_store(Request $request){
        $comprobante_detalle = ComprobanteDetalle::create([
            'comprobante_encabezado_id' => $request->comprobante_encabezado_id,
            'objetivos_id' => $request->componente['id'], 
            'cla_presupuestario_id' => $request->partida['id'],
            'cofinanciadores_id' => $request->cofinanciador['id'],
            'concepto' => $request->concepto,
            'monto_bs' => $request->monto_bs,
            'monto_Sus' => $request->monto_sus,
        ]);
        return $comprobante_detalle;
    }

    public function comprobante_detalle_update(Request $request){
        $comprobante_detalle = ComprobanteDetalle::find($request->comprobante_detalle_id);
        $comprobante_detalle->update([
            'comprobante_encabezado_id' => $request->comprobante_encabezado_id,
            'objetivos_id' => $request->componente['id'], 
            'cla_presupuestario_id' => $request->partida['id'],
            'cofinanciadores_id' => $request->cofinanciador['id'],
            'concepto' => $request->concepto,
            'monto_bs' => $request->monto_bs,
            'monto_Sus' => $request->monto_sus,
        ]);
        return $comprobante_detalle;
    }

    public function ver_compobante_detalle($id){
        $comprobante_detalle = ComprobanteDetalle::where('comprobante_encabezado_id', $id)->with('componentes', 'partidas', 'cofinanciadores')->get(); 
        foreach($comprobante_detalle as $comprobante_det){
            if(isset($comprobante_det->cofinanciadores->cofinanciador_documento->titulo)){
                $comprobante_det->cofinanciadores['nombre'] = $comprobante_det->cofinanciadores->cofinanciador_documento->titulo;
            }  
            $comprobante_det->partidas['codigo_nombre'] = $comprobante_det->partidas->codigo . '-' . $comprobante_det->partidas->nombre;
        }       
        return $comprobante_detalle;
    }

    public function comprobante_encabezado_store(Request $request){
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
            $cadenaProcesar = 'Respaldo_de_comprobante_' . $nombre_archivo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            // $nombre_archivo = $request->id_intervencion . '_' . trim($titulo);
            $nombre_archivo = $request->id_intervencion . '_' . $request->id_tipo_documento . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }            
        $request['fecha_text2'] = date("Y-m-d",strtotime($request->fecha_text));        
        $comprobante_encabezado = ComprobanteEncabezado::create([            
            'intervenciones_id' => $request->id_intervencion,
            'fecha' => $request['fecha_text2'],
            'gestion' => $request->gestion,
            'move_finacial_type_id' => $request->id_tipo_movimiento,
            'concepto' => $request->concepto,
            'glosa' => $request->glosa,
            'pathDocumento' => $files,
        ]);
        return $comprobante_encabezado;
    }
    public function comprobante_encabezado_update(Request $request){
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
            $cadenaProcesar = 'Respaldo_de_comprobante_' . $nombre_archivo;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            // $nombre_archivo = $request->id_intervencion . '_' . trim($titulo);
            $nombre_archivo = $request->id_intervencion . '_' . $request->id_tipo_documento . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }            
        $request['fecha_text2'] = date("Y-m-d",strtotime($request->fecha_text));  
        $comprobante_encabezado = ComprobanteEncabezado::find($request->comprobante_encabezado_id);      
        $comprobante_encabezado->update([            
            'intervenciones_id' => $request->id_intervencion,
            'fecha' => $request['fecha_text2'],
            'gestion' => $request->gestion,
            'move_finacial_type_id' => $request->id_tipo_movimiento,
            'concepto' => $request->concepto,
            'glosa' => $request->glosa,
            'pathDocumento' => $files,
        ]);
        return $comprobante_encabezado;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comprobante_encabezado = ComprobanteEncabezado::where('intervenciones_id', $id)->first();
        return $comprobante_encabezado;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {        
        $comprobante_detalle = ComprobanteDetalle::find($id);
        $comprobante_detalle->delete();
        return $comprobante_detalle;
    }

    public function reporte($id){
        $comprobante_encabezado = ComprobanteEncabezado::where('id', $id)->first();        
        $intervencion = Intervencion::where('id', $comprobante_encabezado->intervenciones_id)->first();
        $moneda = 'pesos???';
        $glosa = $comprobante_encabezado->glosa;
        $fecha_registro = $comprobante_encabezado->created_at;
        $nombre_proyecto = $intervencion->nombre;
        $matriz = [];
        $cantidad_cofinanciador_maximo = 0;
        $comprobantes_detalle = ComprobanteDetalle::where('comprobante_encabezado_id', $comprobante_encabezado->id)->with('componentes', 'partidas', 'cofinanciadores')->get();        
        $componentes = $this->calcula_componentes($comprobantes_detalle);  
        // dump($comprobantes_detalle->toArray());
        // dd($componentes);
        $doc_asociados = [$comprobante_encabezado->pathDocumento];        
        foreach($comprobantes_detalle as $doc){
            $doc_asociados = array_merge($doc_asociados, [$doc->cofinanciadores->cofinanciador_documento->pathDocumento]);
        }
        $pdf = PDF::loadView('front-end.reportes.estructura_financiamiento.pdf.reporte', [
                                                                                            'glosa'=>$glosa, 
                                                                                            'fecha_registro'=>$fecha_registro, 
                                                                                            'nombre_proyecto'=>$nombre_proyecto, 
                                                                                            'moneda'=>$moneda,
                                                                                            'componentes'=>$componentes,
                                                                                            'doc_asociados'=>$doc_asociados
                                                                                        ]);        
        $pdf->setPaper('letter', 'portrait');
        // $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('reporte_estructura_financiamiento.pdf');
        // return  $pdf->download('reporte_estructura_financiamiento.pdf');  
    }
    function calcula_componentes($comprobantes_detalle){//calculando componentes
        $componentes = [];
        $cant_cofinanciadores_max = 0;
        foreach($comprobantes_detalle as $comprobante){
            $componente_existe = false;
            foreach($componentes as $componente){
                if($componente['id'] == $comprobante->objetivos_id){
                    $componente_existe = true;
                }
            }
            if($componente_existe == false){
                $partidas = [];  
                $cant_partidas = 0;
                foreach($comprobantes_detalle as $comprovante_partidas){
                    $partida_existe = false;  
                    foreach($partidas as $partida){       
                        if($partida['id'] == $comprovante_partidas->cla_presupuestario_id && $comprobante->objetivos_id == $comprovante_partidas->objetivos_id){                            
                            $partida_existe = true;
                        }
                    } 
                    if($partida_existe == false && $comprobante->objetivos_id == $comprovante_partidas->objetivos_id){                        
                        $cofinanciadores = [];     
                        $cant_cofinanciadores = 0;        
                        foreach($comprobantes_detalle as $comprovante_cofinanciadores){
                            $cofinanciador_existe = false;  
                            foreach($cofinanciadores as $cofinanciador){
                                if($cofinanciador['id'] == $comprovante_cofinanciadores->cofinanciadores_id && $comprovante_partidas->cla_presupuestario_id == $comprovante_cofinanciadores->cla_presupuestario_id && $comprobante->objetivos_id == $comprovante_cofinanciadores->objetivos_id){
                                    $cofinanciador_existe = true;
                                }
                            } 
                            if($cofinanciador_existe == false && $comprovante_partidas->cla_presupuestario_id == $comprovante_cofinanciadores->cla_presupuestario_id && $comprobante->objetivos_id == $comprovante_cofinanciadores->objetivos_id){      
                                $cant_cofinanciadores++;
                                array_push($cofinanciadores, ['id'=>$comprovante_cofinanciadores->cofinanciadores->id, 'nombre'=>$comprovante_cofinanciadores->cofinanciadores->cofinanciador_documento->titulo]);
                            }
                        }
                        if($cant_cofinanciadores_max < $cant_cofinanciadores){
                            $cant_cofinanciadores_max = $cant_cofinanciadores;
                        }
                        $cant_partidas++;
                        array_push($partidas, ['id'=>$comprovante_partidas->partidas->id, 'nombre'=>$comprovante_partidas->partidas->nombre,'cant_cofinanciadores'=>$cant_cofinanciadores, 'cofinanciadores'=>$cofinanciadores]);                    
                    }
                }
                array_push($componentes, ['id'=>$comprobante->componentes->id, 'nombre'=>$comprobante->componentes->desc_corta, 'cant_partidas'=>$cant_partidas, 'partidas'=>$partidas]);
            }            
        }
        return ['componentes'=>$componentes, 'cant_cofinanciadores_max'=>$cant_cofinanciadores_max];
    }
    public function tipo_cambio_bs_sus()
    {
        $hoy = date("Y") . '-' . date("m") . '-' . date("d");
        $resultado = CotizacionDolar::where('fecha', $hoy)->first();
        return $resultado;
    }
    public function buscando_encabezado(Request $request)
    {
        $comprobante_encabezado = ComprobanteEncabezado::where('intervenciones_id', $request->proyectos['id'])->where('move_finacial_type_id', $request->tipo_movimiento['id'])->first();
        return $comprobante_encabezado;
    }
    public function buscar_encabezados(Request $request)
    {
        $aux = new ComprobanteEncabezado;
        $comprobantes_encabezados = ComprobanteEncabezado::where('intervenciones_id', $request->proyectos['id'])->where('gestion', $request->gestion)->with('tipos')->get();
        foreach($comprobantes_encabezados as $comprobantes_encabezado){
            $comprobantes_encabezado['monto_bs'] = $aux->montoBS($comprobantes_encabezado->id);
            $comprobantes_encabezado['monto_Sus'] = $aux->montoSUS($comprobantes_encabezado->id);
            if($comprobantes_encabezado->move_finacial_type_id == 4 || $comprobantes_encabezado->move_finacial_type_id == 5){
                $comprobantes_encabezado['status'] = "si";
            }else{
                $comprobantes_encabezado['status'] = "no";
            }
            
        }
        return $comprobantes_encabezados;
    }
    
    public function editar_desde_encabezado($id)
    {
        $comprobante_encabezado = ComprobanteEncabezado::where('id', $id)->first();
        return $comprobante_encabezado;
    }
    public function eliminar_desde_encabezado($id){
        $comprobante_encabezado = ComprobanteEncabezado::where('id', $id)->first();
        $comprobante_detalles = ComprobanteDetalle::where('comprobante_encabezado_id', $id)->get();
        foreach($comprobante_detalles as $comprobante_detalle){
            $comprobante_detalle2 = ComprobanteDetalle::where('id', $comprobante_detalle->id)->first();
            $comprobante_detalle2->delete();
        }
        $comprobante_encabezado->delete();
        return "correcto";
    }
}
