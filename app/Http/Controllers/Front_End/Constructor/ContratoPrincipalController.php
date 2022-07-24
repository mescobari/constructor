<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\intervenciones\Intervencion;
use App\Models\FrontEnd\intervenciones\ClaSectorial;
use App\Models\FrontEnd\marco_logico\Objetivo;
class ContratoPrincipalController extends Controller
{
    
    public function inicio()
    {
        return view('front-end.constructor.IndexContratoPrincipal');
    }    

    public function intervencionesUsuario(Request $request){
        $data = Intervencion::where('institucion_id', auth()->user()->funcionario_user_auth()->institucion_id)->with('institucion', 'tipo_intervencion', 'sectorial')->get();        
        foreach($data as $dat){
            $dat['filePathFull'] = $request->getSchemeAndHttpHost() . '/' . $dat->path_proyecto;
        }
        return($data);
        $sectores = ClaSectorial::all();
        foreach($data as $dat){
            $dat->fecha_aprobacion = date('d-m-Y', strtotime($dat->fecha_aprobacion));
            $sectorial = [];
            foreach($sectores as $sectore){
                if($sectore->id == $dat->sectorial_id){
                    $sectorial = $sectore;
                }
            }
            $sector = [];
            foreach($sectores as $sectore){
                if($sectore->id == $sectorial->sector){
                    $sector = $sectore;
                }
            }
            if(isset($sector)){
                $dat->sectorial_literal = $sector->denominacion;
            }else{
                $dat->sectorial_literal = "";
            }
        }
        return $data;
    }

    public function index(Request $request)
    {
        $data = Intervencion::with('institucion', 'tipo_intervencion', 'sectorial')->get();
        foreach($data as $dat){
            $dat['filePathFull'] = $request->getSchemeAndHttpHost() . '/' . $dat->path_proyecto;
        }
        return($data);
        $sectores = ClaSectorial::all();
        foreach($data as $dat){
            $dat->fecha_aprobacion = date('d-m-Y', strtotime($dat->fecha_aprobacion));
            $sectorial = [];
            foreach($sectores as $sectore){
                if($sectore->id == $dat->sectorial_id){
                    $sectorial = $sectore;
                }
            }
            $sector = [];
            foreach($sectores as $sectore){
                if($sectore->id == $sectorial->sector){
                    $sector = $sectore;
                }
            }
            if(isset($sector)){
                $dat->sectorial_literal = $sector->denominacion;
            }else{
                $dat->sectorial_literal = "";
            }
        }
        return $data;
    }

    public function proyectos(){
        $data = Intervencion::all();
        return $data;
    }

    public function store(Request $request)
    {
        // return "fer";  
        // return $request;
        // $datos = [
        //     $request->institucion['id'],
        //     $request->tipo_intervencion['id'],
        //     $request->nombre,
        //     $request->codsisin,
        //     $request->sectorial['id'],
        //     $request->fecha_aprobacion,
        //     $request->fecha_inicial_programada,
        //     $request->duracion_dias,
        //     $request->fecha_inicial_real,
        //     $request->descripcion,
        //     $request->monto_aprobado_bs,
        //     $request->monto_aprobado_dolares,
        // ];
        // return $datos;
        // return $request->tipo_intervencion_id;
        // $intervencion = new Intervencion;
        // return $intervencion;
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $nombre_carpeta = $request->institucion_id . "/" . $request->tipo_intervencion_id . "/intervenciones";
        $files = "";
        if($request->hasFile('files')){
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            // $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo       
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = $request->nombre;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            $nombre_archivo = $request->tipo_intervencion_id . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }
        $resultado = Intervencion::create([
                'institucion_id' => $request->institucion_id,
                'inteventiontype_id' => $request->tipo_intervencion_id,
                'nombre' => $request->nombre,
                'codsisin' => $request->codsisin,
                'sectorial_id' => $request->sectorial_id,
                'fecha_aprobacion' => date('Y-m-d', strtotime($request->fecha_aprobacion_dat)),
                'fecha_inicial_programada' => date('Y-m-d', strtotime($request->fecha_inicial_programada_dat)),
                'duracion_dias' => $request->duracion_dias,
                // 'fecha_inicial_real' => date('Y-m-d', strtotime($request->fecha_inicial_real)),
                'descripcion' => $request->descripcion,
                'monto_aprobado_bs' => $request->monto_aprobado_bs,
                'monto_aprobado_dolares' => $request->monto_aprobado_dolares,  
                'path_proyecto' => $files,                          
        ]);        
        $resultadoObjetivo = Objetivo::create([
            'intervenciones_id' => $resultado->id,
            'objetivetype_id' => 1,
            'padre' => 0,
            'desc_corta' => "fin " . $resultado->nombre ,
            'fecha_inicial_programada' => $resultado->fecha_aprobacion,
            'fecha_final_programada' => $resultado->fecha_inicial_programada,
            'descripcion' => "descripción fin " . $resultado->nombre,
            'duracion_dias' => $resultado->duracion_dias,
            'monto' => $resultado->monto_aprobado_bs,
            'tipo_ejecucion' => true,
        ]);         
        $resultadoObjetivo2 = Objetivo::create([
            'intervenciones_id' => $resultado->id,
            'objetivetype_id' => 2,
            'padre' => $resultadoObjetivo->id,
            'desc_corta' => "proposito " . $resultado->nombre ,
            'fecha_inicial_programada' => $resultado->fecha_aprobacion,
            'fecha_final_programada' => $resultado->fecha_inicial_programada,
            'descripcion' => "descripción proposito " . $resultado->nombre,
            'duracion_dias' => $resultado->duracion_dias,
            'monto' => $resultado->monto_aprobado_bs,
            'tipo_ejecucion' => true,
        ]); 
        return $resultado;
    }

    public function show(Intervencion $intervencion)
    {
        return $intervencion;
    }

    public function update(Request $request)
    {
        // return $request;
        $maximoPeso = (int)ini_get('upload_max_filesize') * 10240;
        $nombre_carpeta = $request->institucion_id . "/" . $request->tipo_intervencion_id . "/intervenciones";
        $files = "";
        if($request->hasFile('files')){
            // $files = $request->file('files')->store('cofinanciadores/' . $nombre_carpeta);//nombre por default del sistema
            // $nombre_archivo = $request->file('files')->getClientOriginalName();//nombre original del archivo       
            $extencion = $request->file('files')->getClientOriginalExtension();   
            $datoBuscar = " ";
            $datoReemplazar = "_";
            $cadenaProcesar = $request->nombre;              
            $titulo = str_replace($datoBuscar, $datoReemplazar, $cadenaProcesar);

            $nombre_archivo = $request->tipo_intervencion_id . '_' . trim($titulo) . '.' . $extencion;
            $files = $request->file('files')->storeAs('documentos/' . $nombre_carpeta, $nombre_archivo);//no recomendado por que sobre escribe aparte puede haber espacios y eso es problemas en navegador
        }

        // return $request;
        $intervencion2 = Intervencion::findOrFail($request->id);
        if($files == ""){
            $files = $intervencion2->path_proyecto;
        }
        $respuesta = $intervencion2->update([
            'institucion_id' => $request->institucion_id,
            'inteventiontype_id' => $request->tipo_intervencion_id,
            'nombre' => $request->nombre,
            'codsisin' => $request->codsisin,
            'sectorial_id' => $request->sectorial_id,
            'fecha_aprobacion' => date('Y-m-d', strtotime($request->fecha_aprobacion_dat)),
            'fecha_inicial_programada' => date('Y-m-d', strtotime($request->fecha_inicial_programada_dat)),
            'duracion_dias' => $request->duracion_dias,
            // 'fecha_inicial_real' => date('Y-m-d', strtotime($request->fecha_inicial_real)),
            'descripcion' => $request->descripcion,
            'monto_aprobado_bs' => $request->monto_aprobado_bs,
            'monto_aprobado_dolares' => $request->monto_aprobado_dolares,  
            'path_proyecto' => $files,   
        ]);     

        // return $request;
        // $respuesta = $intervencion->update($request->all());
        return $respuesta;
    }

    public function destroy($id)
    {
        $intervencion = Intervencion::findOrFail($id);
        $intervencion->delete();
        return "registro eliminado";
    }
}
