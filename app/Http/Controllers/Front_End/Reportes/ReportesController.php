<?php

namespace App\Http\Controllers\Front_End\Reportes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\User;
use App\Models\FrontEnd\intervenciones\Intervencion;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\FrontEnd\Localizacion;
use App\Models\FrontEnd\LocalizacionIntervencion;
use App\Models\FrontEnd\LocalizacionTipo;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;
use App\Models\FrontEnd\cofinanciadores\CofinanciadorDocumento;
use App\Models\FrontEnd\estructura_financiamiento\ComprobanteEncabezado;
use App\Models\FrontEnd\estructura_financiamiento\ComprobanteDetalle;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportesController extends Controller
{
    public function inicio()
    {
        return view('front-end.reportes.IndexReportes');
    }
    public function Reportes_documentos_legales()
    {
        return view('front-end.reportes.IndexReportesDocumentosLegales');
    }
    /* documentos legales de un proyecto inicio */
    public function documentos_de_proyecto_reporte($id_proyecto){
        $documentos_legales_padres = [];
        $documentos_legales = Cofinanciador::where('intervenciones_id', $id_proyecto)->with('cofinanciador_documento')->get();
        foreach($documentos_legales as $documentos_legal){
            if($documentos_legal->cofinanciador_documento->padre == 0){
                $documentos_legal['documento'] = $documentos_legal->cofinanciador_documento->titulo;
                array_push($documentos_legales_padres, $documentos_legal);
            }
        }
        return $documentos_legales_padres;
    }
    public function documentos_legales_vigencia($id_documento){
        $documentos_legales = Cofinanciador::where('id', $id_documento)->with('cofinanciador_documento')->first();
        $proyecto = Intervencion::where('id', $documentos_legales->intervenciones_id)->first();
        $codgioQR = QrCode::size(50)->generate("holas");
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = "DOCUMENTOS LEGALES - PLAZO DE VIGENCIA - MONTO APORTE APMT";
        $siglas = "SISPRO";
        $codigo_proyecto = "";
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $nombre_proyecto = $proyecto->nombre;
        //todos los departamentos y un municipio
        $ubicaciones = $this->BuscaUbicacionesRegistradas($proyecto->id);
        $departamento = [];
        $municipio = [];
        foreach($ubicaciones as $ubicacion){
            if(isset($ubicacion['nombre1'])){
                $existe = 0;
                foreach($departamento as $item){
                    if($item == $ubicacion['nombre1']){
                        $existe++;
                    }
                }
                if($existe == 0){
                    $departamento = array_merge($departamento, ['id' . $ubicacion['id'] . 'd' => $ubicacion['nombre1']]);
                }                
            }
            if(isset($ubicacion['nombre3'])){
                $existe = 0;
                foreach($municipio as $item){
                    if($item == $ubicacion['nombre3']){
                        $existe++;
                    }
                }
                if($existe == 0){
                    $municipio = array_merge($municipio, ['id' . $ubicacion['id'] . 'd' => $ubicacion['nombre3']]);
                }                
            }            
        }
        // dd($documentos_legales->cofinanciador_documento->id);
        $fecha_real_inicio = $proyecto->fecha_inicial_real;
        $documento_inicio = $documentos_legales->cofinanciador_documento->tipo_documento->nombre;
        $documentos_legales_hijos = CofinanciadorDocumento::where('padre', $documentos_legales->cofinanciador_documento->id)->orderBy('fecha_firma', 'asc')->get();
        $documentos_legales_hijos_fecha_vencimiento = CofinanciadorDocumento::where('padre', $documentos_legales->cofinanciador_documento->id)->orderBy('fecha_vencimiento', 'desc')->first();
        $matriz_doc_legales = [];
        $total = 0;
        // dd($documentos_legales->cofinanciador_documento->monto_bs);
        $total = $total + $documentos_legales->cofinanciador_documento->monto_bs;
        $matriz_doc_legales_aux = [
            'nombre' => $documentos_legales->cofinanciador_documento->titulo,
            'fecha_inicio' => $documentos_legales->cofinanciador_documento->fecha_inicio,
            'duracion' => $documentos_legales->cofinanciador_documento->duracion_dias,
            'fecha_fin' => $documentos_legales->cofinanciador_documento->fecha_vencimiento,
            'monto' => $documentos_legales->cofinanciador_documento->monto_bs,
            'monto_modificado' => $total
        ];
        array_push($matriz_doc_legales, $matriz_doc_legales_aux);
        foreach($documentos_legales_hijos as $documentos_legales_hijo){
            // dd($documentos_legales_hijo->monto_bs);
            $total = $total + $documentos_legales_hijo->monto_bs;
            $matriz_doc_legales_aux = [
                'nombre' => $documentos_legales_hijo->titulo,
                'fecha_inicio' => $documentos_legales_hijo->fecha_inicio,
                'duracion' => $documentos_legales_hijo->duracion_dias,
                'fecha_fin' => $documentos_legales_hijo->fecha_vencimiento,
                'monto' => $documentos_legales_hijo->monto_bs,
                'monto_modificado' => $total
            ];
            array_push($matriz_doc_legales, $matriz_doc_legales_aux);
        }
        $ultimo_plazo_vigencia = "";
        if(isset($documentos_legales_hijos_fecha_vencimiento->fecha_vencimiento)){
            $ultimo_plazo_vigencia = $documentos_legales_hijos_fecha_vencimiento->fecha_vencimiento;
        }
        $comprobante_encabezados = ComprobanteEncabezado::where('intervenciones_id', $proyecto->id)->get();
        $monto_comprometido = 0;
        foreach($comprobante_encabezados as $comprobante_encabezado){
            $comprobantes_detalles = ComprobanteDetalle::where('comprobante_encabezado_id', $comprobante_encabezado->id)->with('cofinanciadores')->get();   
            // dd($comprobantes_detalles);
            foreach($comprobantes_detalles as $comprobantes_detalle){
                $id_inst = 196;
                if(isset(auth()->user()->funcionario_user_auth()->institucion_id)){
                    $id_inst = auth()->user()->funcionario_user_auth()->institucion_id;
                }
                if($id_inst == $comprobantes_detalle->cofinanciadores->institucion_id){
                    if(isset($comprobantes_detalle->monto_bs)){
                        $monto_comprometido = $monto_comprometido + $comprobantes_detalle->monto_bs;
                    }    
                }            
            }
        }
        $firstDate = $ultimo_plazo_vigencia;
        $secondDate = date('Y/m/d', time());
        $secondDate = $secondDate . '';
        $dateDifference = abs(strtotime($firstDate) - strtotime($secondDate));
        $years  = floor($dateDifference / (365 * 60 * 60 * 24));
        $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));
        $dias_vencimiento = number_format($dateDifference / (60 * 60 * 24),0);        
        // dump($firstDate);
        // dump($secondDate);
        // dd($dias_vencimiento);
        $responsables_proyecto = [];
        array_push($responsables_proyecto, ['responsable_firma'=>$documentos_legales->cofinanciador_documento->firma]);
        foreach($documentos_legales_hijos as $documentos_legales_hijo){
            array_push($responsables_proyecto, ['responsable_firma'=>$documentos_legales_hijo->firma]);
        }
        $fecha_emision = date('d/m/Y', time());
        // dd($departamento);
        // dd($matriz_doc_legales);
        $pdf = PDF::loadView('front-end.reportes.documentos_legales.pdf.reporte', [
            'QR' => $codgioQR,
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'codigo_proyecto' => $codigo_proyecto,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $nombre_proyecto,
            'departamento' => $departamento,
            'municipio' => $municipio,
            'fecha_real_inicio' => $fecha_real_inicio,
            'documento_inicio' => $documento_inicio,
            'matriz_doc_legales' => $matriz_doc_legales,
            'ultimo_plazo_vigencia' => $ultimo_plazo_vigencia,
            'monto_comprometido' => $monto_comprometido,
            'dias_vencimiento' => $dias_vencimiento,
            'responsables_proyecto' => $responsables_proyecto,
            'fecha_emision' => $fecha_emision,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_documentos_legales.pdf');
    }
    /* documentos legales de un proyecto inicio */
    /* ficha de proyecto inicio */
    public function ficha_proyecto(Request $request, $id){        
        $intervencion = Intervencion::where('id', $id)->with('institucion','sectorial')->first();        
        //datos del reporte
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = $intervencion->institucion->nombre;
        $siglas = "SISPRO";
        $codigo_proyecto = $intervencion->codsisin;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $nombre_proyecto = $intervencion->nombre;
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $nombre_institucion;
        $duracion_proyecto_inicio = $intervencion->fecha_inicial_programada;
        $duracion_proyecto_fin = $intervencion->fecha_aprobacion;
        $clasificador_sectorial_codigo = $intervencion->sectorial->sigla;
        $clasificador_sectorial_descripcion = $intervencion->sectorial->denominacion;
        $descripcion_proyecto = $intervencion->descripcion;        
        $proposito = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 2)->first();
        $componentes = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 3)->get();
        $localizacion_geografica = $this->BuscaUbicacionesRegistradas($intervencion->id);
        $matriz = [];
        if(isset($intervencion->path_proyecto) && $intervencion->path_proyecto != ''){
            array_push($matriz, ['descripcion'=>$intervencion->nombre, 'link'=>$request->getSchemeAndHttpHost() . '/' . $intervencion->path_proyecto]);
        }
        $estructura_financiamiento = $this->BuscarEstructurasFinanciamiento($intervencion->id);
        // dd($estructura_financiamiento);
        $documentacion_respaldo = $this->DocumentosRespaldo($intervencion->id, $request, $matriz);
        // dd($documentacion_respaldo->toArray());
        //generando pdf
        // dd($documentacion_respaldo);
        $pdf = PDF::loadView('front-end.reportes.ficha_proyecto.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'codigo_proyecto' => $codigo_proyecto,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $nombre_proyecto,
            'entidad_ejecutora' => $entidad_ejecutora,
            'duracion_proyecto_inicio' => $duracion_proyecto_inicio,
            'duracion_proyecto_fin' => $duracion_proyecto_fin,
            'clasificador_sectorial_codigo' => $clasificador_sectorial_codigo,
            'clasificador_sectorial_descripcion' => $clasificador_sectorial_descripcion,
            'descripcion_proyecto' => $descripcion_proyecto,
            'proposito' => $proposito,
            'componentes' => $componentes,            
            'localizacion_geografica' => $localizacion_geografica,
            'estructura_financiamiento' => $estructura_financiamiento,
            'documentacion_respaldo' => $documentacion_respaldo,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto.pdf');
    }    
    public function proyectos_de_institucion_reporte(){        
        $respuestaUser = User::where('id', auth()->user()->id)->with('datos')->get();//me va dar el id de institucion
        $respuestaInstitucion = Intervencion::where('institucion_id', $respuestaUser[0]->datos->institucion_id)->get();//me va dar los proyectos de la institucion         
        return $respuestaInstitucion;
    }
    public function DocumentosRespaldo($id_proyecto, $request, $matriz){

        $cofinanciadores = Cofinanciador::where('intervenciones_id', $id_proyecto)->with('cofinanciador_documento')->get();         
        foreach($cofinanciadores as $cofinanciador){
            if(isset($cofinanciador->cofinanciador_documento->pathDocumento) && $cofinanciador->cofinanciador_documento->pathDocumento != ''){
                array_push($matriz, ['descripcion'=>$cofinanciador->cofinanciador_documento->objeto, 'link'=>$request->getSchemeAndHttpHost() . '/' . $cofinanciador->cofinanciador_documento->pathDocumento]);
            }
        }
        $planificaciones = Objetivo::where('intervenciones_id', $id_proyecto)->with('resultados')->get();
        foreach($planificaciones as $planificacion){
            if(isset($planificacion->resultados)){
                foreach($planificacion->resultados as $resultado){
                    if(isset($resultado->indicador_resultados)){
                        foreach($resultado->indicador_resultados as $indicador_resultado){
                            if(isset($indicador_resultado->indicador_planificaciones)){
                                foreach($indicador_resultado->indicador_planificaciones as $indicador_planificacion){
                                    if(isset($indicador_planificacion->pathDocumento) && $indicador_planificacion->pathDocumento != ''){
                                        array_push($matriz, ['descripcion'=>$indicador_planificacion->glosa, 'link'=>$request->getSchemeAndHttpHost() . '/' . $indicador_planificacion->pathDocumento]);
                                    }                                    
                                }
                            }
                        }
                    }
                }
            }
        }
        $estructura_financiamientos = ComprobanteEncabezado::where('intervenciones_id', $id_proyecto)->get();
        foreach($estructura_financiamientos as $estructura_financiamiento){
            if(isset($estructura_financiamiento->pathDocumento) && $estructura_financiamiento->pathDocumento != ''){
                array_push($matriz, ['descripcion'=>$estructura_financiamiento->glosa, 'link'=>$request->getSchemeAndHttpHost() . '/' . $estructura_financiamiento->pathDocumento]);
            }
        }
        return $matriz;
    }    
    public function BuscarEstructurasFinanciamiento($id_proyecto){    
        $matriz = [];
        $matriz_aux = [];
        $nombre_cofinanciadores = ['componente'=>'Componente', 'partida'=>'Partida'];
        $nombre_cofinanciadores_total = ['componente'=>'', 'partida'=>'Total'];
        $total = 0;
        $comprobante_encabezados = ComprobanteEncabezado::where('intervenciones_id', $id_proyecto)->get();
        foreach($comprobante_encabezados as $comprobante_encabezado){
            $comprobantes_detalles = ComprobanteDetalle::where('comprobante_encabezado_id', $comprobante_encabezado->id)->with('componentes', 'partidas', 'cofinanciadores')->orderBy('objetivos_id','asc')->orderBy('cla_presupuestario_id', 'asc')->orderBy('cofinanciadores_id', 'asc')->get();
            //creamos las variables qwue nos serviran para llenar si existe mas de un cofinanciadors que corresponda al mismo componente y partida
            foreach($comprobantes_detalles as $comprobantes_detalle){
                // dd($comprobantes_detalle->toArray());
                $existe = 0;
                foreach($matriz as $mat){
                    if($comprobantes_detalle->componentes->id == $mat['componente_id']){
                        if($comprobantes_detalle->partidas->id == $mat['partida_id']){
                            $existe++;
                        }
                    }                    
                }
                if($existe == 0){
                    array_push($matriz, [
                        'componente_id'=>$comprobantes_detalle->componentes->id,
                        'componente'=>$comprobantes_detalle->componentes->desc_corta,
                        'partida_id'=>$comprobantes_detalle->partidas->id,
                        'partida'=>$comprobantes_detalle->partidas->nombre,
                    ]);
                }
                $existe = 0;
                foreach($nombre_cofinanciadores as $nombre){
                    if($nombre == $comprobantes_detalle->cofinanciadores->cofinanciador_documento->titulo){
                        $existe++;
                    }
                }                
                if($existe == 0){
                    $nombre_cofinanciadores = array_merge($nombre_cofinanciadores, ['i' . $comprobantes_detalle->cofinanciadores->id . 'd' => $comprobantes_detalle->cofinanciadores->cofinanciador_documento->titulo]);
                    $nombre_cofinanciadores_total = array_merge($nombre_cofinanciadores_total, ['i' . $comprobantes_detalle->cofinanciadores->id . 'd' => 0]);
                }
            }
            //llenamos los valores de los cofinanciadores    
            // dump($comprobantes_detalles->toArray());        
            // $contFER = 0;
            foreach($matriz as $mat){
                $existe = 0;
                $tot = 0;
                // dump($contFER++);
                // dump($comprobantes_detalles->toArray());
                foreach($comprobantes_detalles as $comprobantes_detalle){
                    if($comprobantes_detalle->componentes->id == $mat['componente_id']){
                        if($comprobantes_detalle->partidas->id == $mat['partida_id']){
                            $existe++;
                            $mat = array_merge($mat, [
                                'cofinanciador_id' . $comprobantes_detalle->cofinanciadores->id =>$comprobantes_detalle->cofinanciadores->id, 
                                'cofinanciador' . $comprobantes_detalle->cofinanciadores->id =>$comprobantes_detalle->cofinanciadores->cofinanciador_documento->titulo,
                                'i' . $comprobantes_detalle->cofinanciadores->id . 'd' => $comprobantes_detalle->cofinanciadores->cofinanciador_documento->monto_bs
                            ]);
                            // dump($comprobantes_detalle->id);
                            // dump("-");
                            // dump($tot);
                            $tot = $tot + $comprobantes_detalle->cofinanciadores->cofinanciador_documento->monto_bs;
                            // dump("+");
                            // dump($comprobantes_detalle->cofinanciadores->cofinanciador_documento->monto_bs);
                            // dump($tot);
                            $nombre_cofinanciadores_total['i' . $comprobantes_detalle->cofinanciadores->id . 'd'] = $nombre_cofinanciadores_total['i' . $comprobantes_detalle->cofinanciadores->id . 'd'] + $comprobantes_detalle->cofinanciadores->cofinanciador_documento->monto_bs;
                        }
                    } 
                }
                // dump($tot);
                $total = $total + $tot;
                $mat = array_merge($mat, ['tot'=>$tot]);
                if($existe > 0){
                    array_push($matriz_aux, $mat);
                }
            }
        }
        $nombre_cofinanciadores_total = array_merge($nombre_cofinanciadores_total, ['total' => $total]);
        $nombre_cofinanciadores = array_merge($nombre_cofinanciadores, ['total' => 'Total']);
        $matriz = ['matriz' => $matriz_aux, 'titulos' => $nombre_cofinanciadores, 'total' => $nombre_cofinanciadores_total];
        return $matriz;
    }
    public function BuscaUbicacionesRegistradas($id_proyecto){
        $usbicacionesSeleccionadas = LocalizacionIntervencion::where('intervenciones_id', $id_proyecto)->get();
        $tipos_localizacion = LocalizacionTipo::orderBy('id', 'desc')->get();
        $respuesta2 = [];
        $id_localizaciones_seleccionadas = [];
        foreach($usbicacionesSeleccionadas as $usbicacioneSeleccionada){
            $id_localizaciones_seleccionadas = array_merge($id_localizaciones_seleccionadas, [$usbicacioneSeleccionada->localizaciones_id]);
        }
        $localizaciones_seleccionadas = Localizacion::whereIn('id', $id_localizaciones_seleccionadas)->get();
        foreach($localizaciones_seleccionadas as $localizacion){
            $cont = 0;
            $localizacion_x = $localizacion;
            $arregloTodosTiposLocalizaciones = [];
            $primerArreglo = [];

            $perteneceDepartamento = true;

            foreach($tipos_localizacion as $tipo_localizacion){
                //lo que vamos a hacer es: preguntas es uno debes buscar 2localizacionesFull,3,4,5 es 2 debes buscar 1,3,4,5 y asi sucesivamente dentro de nuestro full array buscar todas las conincidencias y assignar el nombre que corresponde segun el array
                if($localizacion->locationtype_id == $tipo_localizacion->id){//preguntar si estamos en tipo de localizacion buscado
                    $primerArreglo = ['nombre' . $tipo_localizacion->id => $localizacion->nombre];
                    
                }
                if(empty($primerArreglo)){//si esta vacio entonces aun no encontramos la igualdad de localizacion por lo que tenemos el nivel superior pero no el inferior, en todo caso asignaremos valor nulo                    
                    $array_aux = ['nombre' . $tipo_localizacion->id => "-"];
                    $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                }else{//si no esta vacio entonces quiere decir que ya tenemos un vector con el valor inicial                    
                    if($cont == 0){//es la primera vez que hay valores en el vector                        
                        $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $primerArreglo);
                    }else{//no es la primera vez es la x veces
                        //entonces lo que debemos hacer es buscar el id de padre con respecto a el $primerArreglo y asignarle el valor obtenido a $primerArreglo tal como fue la primera vez
                        $cont_aux = 0;

                        if(!isset($localizacion_x->padre)){
                            return "falta un id de padre ... la integridad de la base de datos se encuentra comprometida";
                        }
                        $localizacion_aux = Localizacion::where('id', $localizacion_x->padre)->first();
                        if(isset($localizacion_aux->nombre)){
                            $localizacion_x = $localizacion_aux;
                            $array_aux = ['nombre' . $tipo_localizacion->id => $localizacion_x->nombre];
                            $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, $array_aux);
                            $cont_aux++;
                            
                        } 
                    }
                    $cont++;
                }
            }
            if($perteneceDepartamento == true){//validador de departamentos
                $perteneceAlProyecto = false;
                foreach($usbicacionesSeleccionadas as $ubicacionSeleccionada){
                    if($ubicacionSeleccionada->localizaciones_id == $localizacion->id){
                        $perteneceAlProyecto = true;
                    }
                }
                // $respuesta = $localizaciones;
                $checke = 0;
                if($perteneceAlProyecto == true){
                    $checke = 1;
                }else{
                    $checke = 0;
                }
                $arregloTodosTiposLocalizaciones = array_merge($arregloTodosTiposLocalizaciones, ['estado_check'=>$checke]);
                $respuesta_aux = array_merge($localizacion->toArray(), $arregloTodosTiposLocalizaciones);
                array_push($respuesta2, $respuesta_aux);
            }
        }

        $respuesta = $respuesta2;
        return $respuesta;
    }
        /* inicio localizacion */
    public function ficha_proyecto_localizacion(Request $request, $id){ 
        $intervencion = Intervencion::where('id', $id)->with('institucion','sectorial')->first();        
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = $intervencion->institucion->nombre;
        $siglas = "SISPRO";
        $codigo_proyecto = $intervencion->codsisin;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $nombre_proyecto = $intervencion->nombre;
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $nombre_institucion;
        $duracion_proyecto_inicio = $intervencion->fecha_inicial_programada;
        $duracion_proyecto_fin = $intervencion->fecha_aprobacion;
        $clasificador_sectorial_codigo = $intervencion->sectorial->sigla;
        $clasificador_sectorial_descripcion = $intervencion->sectorial->denominacion;
        $descripcion_proyecto = $intervencion->descripcion;        
        $proposito = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 2)->first();
        $componentes = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 3)->get();
        $localizacion_geografica = $this->BuscaUbicacionesRegistradas($intervencion->id);
        $matriz = [];
        if(isset($intervencion->path_proyecto) && $intervencion->path_proyecto != ''){
            array_push($matriz, ['descripcion'=>$intervencion->nombre, 'link'=>$request->getSchemeAndHttpHost() . '/' . $intervencion->path_proyecto]);
        }
        $estructura_financiamiento = $this->BuscarEstructurasFinanciamiento($intervencion->id);
        $documentacion_respaldo = $this->DocumentosRespaldo($intervencion->id, $request, $matriz);
        $pdf = PDF::loadView('front-end.reportes.ficha_proyecto.localizacion.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'codigo_proyecto' => $codigo_proyecto,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $nombre_proyecto,
            'entidad_ejecutora' => $entidad_ejecutora,
            'duracion_proyecto_inicio' => $duracion_proyecto_inicio,
            'duracion_proyecto_fin' => $duracion_proyecto_fin,
            'clasificador_sectorial_codigo' => $clasificador_sectorial_codigo,
            'clasificador_sectorial_descripcion' => $clasificador_sectorial_descripcion,
            'descripcion_proyecto' => $descripcion_proyecto,
            'proposito' => $proposito,
            'componentes' => $componentes,            
            'localizacion_geografica' => $localizacion_geografica,
            'estructura_financiamiento' => $estructura_financiamiento,
            'documentacion_respaldo' => $documentacion_respaldo,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto_localizacion.pdf');
    }
        /* fin localizacion */
        /* inicio estructura financiamiento */
    public function ficha_proyecto_estructura_financiamiento(Request $request, $id){         
        $intervencion = Intervencion::where('id', $id)->with('institucion','sectorial')->first();        
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = $intervencion->institucion->nombre;
        $siglas = "SISPRO";
        $codigo_proyecto = $intervencion->codsisin;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $nombre_proyecto = $intervencion->nombre;
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $nombre_institucion;
        $duracion_proyecto_inicio = $intervencion->fecha_inicial_programada;
        $duracion_proyecto_fin = $intervencion->fecha_aprobacion;
        $clasificador_sectorial_codigo = $intervencion->sectorial->sigla;
        $clasificador_sectorial_descripcion = $intervencion->sectorial->denominacion;
        $descripcion_proyecto = $intervencion->descripcion;        
        $proposito = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 2)->first();
        $componentes = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 3)->get();
        $localizacion_geografica = $this->BuscaUbicacionesRegistradas($intervencion->id);
        $matriz = [];
        if(isset($intervencion->path_proyecto) && $intervencion->path_proyecto != ''){
            array_push($matriz, ['descripcion'=>$intervencion->nombre, 'link'=>$request->getSchemeAndHttpHost() . '/' . $intervencion->path_proyecto]);
        }
        $estructura_financiamiento = $this->BuscarEstructurasFinanciamiento($intervencion->id);
        $documentacion_respaldo = $this->DocumentosRespaldo($intervencion->id, $request, $matriz);
        // dd($estructura_financiamiento);
        $pdf = PDF::loadView('front-end.reportes.ficha_proyecto.estructura_financiamiento.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'codigo_proyecto' => $codigo_proyecto,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $nombre_proyecto,
            'entidad_ejecutora' => $entidad_ejecutora,
            'duracion_proyecto_inicio' => $duracion_proyecto_inicio,
            'duracion_proyecto_fin' => $duracion_proyecto_fin,
            'clasificador_sectorial_codigo' => $clasificador_sectorial_codigo,
            'clasificador_sectorial_descripcion' => $clasificador_sectorial_descripcion,
            'descripcion_proyecto' => $descripcion_proyecto,
            'proposito' => $proposito,
            'componentes' => $componentes,            
            'localizacion_geografica' => $localizacion_geografica,
            'estructura_financiamiento' => $estructura_financiamiento,
            'documentacion_respaldo' => $documentacion_respaldo,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto_estructura_financiamiento.pdf');
    }
        /* fin estructura financiamiento */
        /* inicio documentos */
    public function ficha_proyecto_documentos(Request $request, $id){         
        $intervencion = Intervencion::where('id', $id)->with('institucion','sectorial')->first();        
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = $intervencion->institucion->nombre;
        $siglas = "SISPRO";
        $codigo_proyecto = $intervencion->codsisin;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $nombre_proyecto = $intervencion->nombre;
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $nombre_institucion;
        $duracion_proyecto_inicio = $intervencion->fecha_inicial_programada;
        $duracion_proyecto_fin = $intervencion->fecha_aprobacion;
        $clasificador_sectorial_codigo = $intervencion->sectorial->sigla;
        $clasificador_sectorial_descripcion = $intervencion->sectorial->denominacion;
        $descripcion_proyecto = $intervencion->descripcion;        
        $proposito = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 2)->first();
        $componentes = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 3)->get();
        $localizacion_geografica = $this->BuscaUbicacionesRegistradas($intervencion->id);
        $matriz = [];
        if(isset($intervencion->path_proyecto) && $intervencion->path_proyecto != ''){
            array_push($matriz, ['descripcion'=>$intervencion->nombre, 'link'=>$request->getSchemeAndHttpHost() . '/' . $intervencion->path_proyecto]);
        }
        $estructura_financiamiento = $this->BuscarEstructurasFinanciamiento($intervencion->id);
        $documentacion_respaldo = $this->DocumentosRespaldo($intervencion->id, $request, $matriz);
        $pdf = PDF::loadView('front-end.reportes.ficha_proyecto.documento.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'codigo_proyecto' => $codigo_proyecto,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $nombre_proyecto,
            'entidad_ejecutora' => $entidad_ejecutora,
            'duracion_proyecto_inicio' => $duracion_proyecto_inicio,
            'duracion_proyecto_fin' => $duracion_proyecto_fin,
            'clasificador_sectorial_codigo' => $clasificador_sectorial_codigo,
            'clasificador_sectorial_descripcion' => $clasificador_sectorial_descripcion,
            'descripcion_proyecto' => $descripcion_proyecto,
            'proposito' => $proposito,
            'componentes' => $componentes,            
            'localizacion_geografica' => $localizacion_geografica,
            'estructura_financiamiento' => $estructura_financiamiento,
            'documentacion_respaldo' => $documentacion_respaldo,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto_documentos.pdf');
    }
        /* fin documentos */
    /* ficha de proyecto fin */
    public function seguimiento_comprobante(Request $request, $id, $gestion){    
        if(!isset($gestion)){
            return "Favor de seleccionar Gestión";
        }    
        if(!isset($id)){
            return "Favor de seleccionar Proyecto";
        }    
        $intervencion = Intervencion::where('id', $id)->with('institucion','sectorial')->first();
        
        $aux = new ComprobanteEncabezado;
        $comprobantes_encabezados = ComprobanteEncabezado::where('intervenciones_id', $intervencion->id)->where('gestion', $gestion)->with('tipos')->get();
        $cont = 0;
        $total_bs = 0;
        $total_sus = 0;
        foreach($comprobantes_encabezados as $comprobantes_encabezado){
            $cont++;
            $comprobantes_encabezado['monto_bs'] = $aux->montoBS($comprobantes_encabezado->id);            
            $comprobantes_encabezado['monto_Sus'] = $aux->montoSUS($comprobantes_encabezado->id);
            $total_bs = $total_bs + $comprobantes_encabezado['monto_bs'];
            $total_sus = $total_sus + $comprobantes_encabezado['monto_Sus'];
            if($comprobantes_encabezado->move_finacial_type_id == 4 || $comprobantes_encabezado->move_finacial_type_id == 5){
                $comprobantes_encabezado['status'] = "si";
            }else{
                $comprobantes_encabezado['status'] = "no";
            }
            $comprobantes_encabezado['numero'] = $cont;
        }
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $intervencion->institucion->nombre;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $pdf = PDF::loadView('front-end.reportes.estructura_financiamiento.pdf.seguimiento_comprobante', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => "MOVIMIENTOS FINANCIEROS - COMPROBANTES",
            'nombre_institucion' => $intervencion->institucion->nombre,
            'siglas' => "SISPRO",
            'codigo_proyecto' => $intervencion->codsisin,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $intervencion->nombre,
            'intervencion' => $intervencion,
            'entidad_ejecutora' => $entidad_ejecutora,
            'comprobantes_encabezados' => $comprobantes_encabezados,
            'total_bs' => $total_bs,
            'total_sus' => $total_sus,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_SEGUIMIENTO_COMPROBANTE.pdf');
    }
    
    public function seguimiento_comprobante_individual(Request $request, $id){
        $comprobantes_encabezados = ComprobanteEncabezado::where('id', $id)->with('tipos')->first();        
        $comprobante_detalles = ComprobanteDetalle::where('comprobante_encabezado_id', $id)->with('componentes', 'partidas', 'cofinanciadores')->get();
        $intervencion = Intervencion::where('id', $comprobantes_encabezados->intervenciones_id)->first();      
        $aux = new ComprobanteEncabezado;  
        $total_bs = $aux->montoBS($comprobantes_encabezados->id);   ;
        $total_sus = $aux->montoSUS($comprobantes_encabezados->id);   ;
        
        $ubicaciones = $this->BuscaUbicacionesRegistradas($intervencion->id);
        $departamento = [];
        $municipio = [];
        foreach($ubicaciones as $ubicacion){
            if(isset($ubicacion['nombre1'])){
                $existe = 0;
                foreach($departamento as $item){
                    if($item == $ubicacion['nombre1']){
                        $existe++;
                    }
                }
                if($existe == 0){
                    $departamento = array_merge($departamento, ['id' . $ubicacion['id'] . 'd' => $ubicacion['nombre1']]);
                }                
            }
            if(isset($ubicacion['nombre3'])){
                $existe = 0;
                foreach($municipio as $item){
                    if($item == $ubicacion['nombre3']){
                        $existe++;
                    }
                }
                if($existe == 0){
                    $municipio = array_merge($municipio, ['id' . $ubicacion['id'] . 'd' => $ubicacion['nombre3']]);
                }                
            }            
        }
        // dump($municipio);
        // dd($intervencion->nombre);
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $intervencion->institucion->nombre;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $pdf = PDF::loadView('front-end.reportes.estructura_financiamiento.pdf.seguimiento_comprobante_individual', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => "COMPROBANTE DE EJECUCIÓN FINANCIERA",
            'nombre_institucion' => $intervencion->institucion->nombre,
            'siglas' => "SISPRO",
            'codigo_proyecto' => $intervencion->codsisin,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $intervencion->nombre,
            'intervencion' => $intervencion,
            'entidad_ejecutora' => $entidad_ejecutora,
            'comprobantes_encabezados' => $comprobantes_encabezados,
            'comprobante_detalles' => $comprobante_detalles,
            'total_bs' => $total_bs,
            'total_sus' => $total_sus,
            'municipio' => $municipio,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_SEGUIMIENTO_COMPROBANTE.pdf');
    }  

    public function ficha_proyecto_estructura_financiamiento2(Request $request, $id){
        $comprobantes_encabezados = ComprobanteEncabezado::where('id', $id)->with('tipos')->first(); 
        //solo reemplazamos por una busqeuda auxiliar para cumplir con los mismos parametros
        $intervencion = Intervencion::where('id', $comprobantes_encabezados->intervenciones_id)->with('institucion','sectorial')->first();        
        $titulo_grande = "SISTEMA DE SEGUIMIENTO A PROYECTOS";
        $nombre_institucion = $intervencion->institucion->nombre;
        $siglas = "SISPRO";
        $codigo_proyecto = $intervencion->codsisin;
        $fecha_hora_emision = date('d-m-Y h:i:s a', time());
        $nombre_proyecto = $intervencion->nombre;
        $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $nombre_institucion;
        $duracion_proyecto_inicio = $intervencion->fecha_inicial_programada;
        $duracion_proyecto_fin = $intervencion->fecha_aprobacion;
        $clasificador_sectorial_codigo = $intervencion->sectorial->sigla;
        $clasificador_sectorial_descripcion = $intervencion->sectorial->denominacion;
        $descripcion_proyecto = $intervencion->descripcion;        
        $proposito = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 2)->first();
        $componentes = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 3)->get();
        $localizacion_geografica = $this->BuscaUbicacionesRegistradas($intervencion->id);
        $matriz = [];
        if(isset($intervencion->path_proyecto) && $intervencion->path_proyecto != ''){
            array_push($matriz, ['descripcion'=>$intervencion->nombre, 'link'=>$request->getSchemeAndHttpHost() . '/' . $intervencion->path_proyecto]);
        }
        $estructura_financiamiento = $this->BuscarEstructurasFinanciamiento($intervencion->id);
        $documentacion_respaldo = $this->DocumentosRespaldo($intervencion->id, $request, $matriz);
        // dd($estructura_financiamiento);
        $pdf = PDF::loadView('front-end.reportes.ficha_proyecto.estructura_financiamiento.cuerpo', [
            'link_img'=>'img/sistema-front-end/logo-pdf.png',
            'titulo_grande' => $titulo_grande,
            'nombre_institucion' => $nombre_institucion,
            'siglas' => $siglas,
            'codigo_proyecto' => $codigo_proyecto,
            'fecha_hora_emision' => $fecha_hora_emision,
            'nombre_proyecto' => $nombre_proyecto,
            'entidad_ejecutora' => $entidad_ejecutora,
            'duracion_proyecto_inicio' => $duracion_proyecto_inicio,
            'duracion_proyecto_fin' => $duracion_proyecto_fin,
            'clasificador_sectorial_codigo' => $clasificador_sectorial_codigo,
            'clasificador_sectorial_descripcion' => $clasificador_sectorial_descripcion,
            'descripcion_proyecto' => $descripcion_proyecto,
            'proposito' => $proposito,
            'componentes' => $componentes,            
            'localizacion_geografica' => $localizacion_geografica,
            'estructura_financiamiento' => $estructura_financiamiento,
            'documentacion_respaldo' => $documentacion_respaldo,
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('reporte_ficha_proyecto_estructura_financiamiento.pdf');
    }

//modificaciones Max +++++++++++++++++++++++++++++

public function mml_proyecto(Request $request, $id){        
    $intervencion = Intervencion::where('id', $id)->with('institucion','sectorial')->first();        
    //datos del reporte
    $titulo_grande = "MATRIZ DEL MARCO LOGICO";
    $nombre_institucion = $intervencion->institucion->nombre;
    $siglas = "SISPRO";
    $codigo_proyecto = $intervencion->codsisin;
    $fecha_hora_emision = date('d-m-Y h:i:s a', time());
    $nombre_proyecto = $intervencion->nombre;
    $entidad_ejecutora = $intervencion->institucion->codigo . ' - ' . $nombre_institucion;
    $duracion_proyecto_inicio = $intervencion->fecha_inicial_programada;
    $duracion_proyecto_fin = $intervencion->fecha_aprobacion;
    $clasificador_sectorial_codigo = $intervencion->sectorial->sigla;
    $clasificador_sectorial_descripcion = $intervencion->sectorial->denominacion;
    $descripcion_proyecto = $intervencion->descripcion;        
    $proposito = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 2)->first();
    $componentes = Objetivo::select('desc_corta', 'descripcion')->where('intervenciones_id', $intervencion->id)->where('objetivetype_id', 3)->get();
    $localizacion_geografica = $this->BuscaUbicacionesRegistradas($intervencion->id);
    $matriz = [];
    if(isset($intervencion->path_proyecto) && $intervencion->path_proyecto != ''){
        array_push($matriz, ['descripcion'=>$intervencion->nombre, 'link'=>$request->getSchemeAndHttpHost() . '/' . $intervencion->path_proyecto]);
    }
    $estructura_financiamiento = $this->BuscarEstructurasFinanciamiento($intervencion->id);
    // dd($estructura_financiamiento);
    $documentacion_respaldo = $this->DocumentosRespaldo($intervencion->id, $request, $matriz);
    // dd($documentacion_respaldo->toArray());
    //generando pdf
    // dd($documentacion_respaldo);
    $pdf = PDF::loadView('front-end.reportes.ficha_proyecto.mml', [
        'link_img'=>'img/sistema-front-end/logo-pdf.png',
        'titulo_grande' => $titulo_grande,
        'nombre_institucion' => $nombre_institucion,
        'siglas' => $siglas,
        'codigo_proyecto' => $codigo_proyecto,
        'fecha_hora_emision' => $fecha_hora_emision,
        'nombre_proyecto' => $nombre_proyecto,
        'entidad_ejecutora' => $entidad_ejecutora,
        'duracion_proyecto_inicio' => $duracion_proyecto_inicio,
        'duracion_proyecto_fin' => $duracion_proyecto_fin,
        'clasificador_sectorial_codigo' => $clasificador_sectorial_codigo,
        'clasificador_sectorial_descripcion' => $clasificador_sectorial_descripcion,
        'descripcion_proyecto' => $descripcion_proyecto,
        'proposito' => $proposito,
        'componentes' => $componentes,            
        'localizacion_geografica' => $localizacion_geografica,
        'estructura_financiamiento' => $estructura_financiamiento,
        'documentacion_respaldo' => $documentacion_respaldo,
    ]);
    $pdf->setPaper('letter', 'landscape');
    return $pdf->stream('reporte_ficha_proyecto.pdf');
}



// fin modificaciones  Max ***************************



}
