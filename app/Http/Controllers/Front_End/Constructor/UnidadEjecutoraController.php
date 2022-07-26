<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Constructor\UnidadEjecutora;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;

use App\Models\FrontEnd\intervenciones\Intervencion;
use App\Models\FrontEnd\intervenciones\ClaSectorial;
use App\Models\FrontEnd\marco_logico\Objetivo;
class UnidadEjecutoraController extends Controller
{
    
    public function inicio()
    {
        return view('front-end.constructor.IndexUnidadEjecutora');
    }    

    public function listarUnidadesEjecutoras(Request $request){
       $institucion_id=auth()->user()->funcionario_user_auth()->institucion_id;
      // dd($institucion_id);
       // $data = UnidadEjecutora::where('institucion_id', '=', $institucion_id)->get(); 
       $data = UnidadEjecutora::all();
       
        
        return($data);

        
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
        $dir_admin_id=1;
        $estado='APROBADO';
        $resultado = UnidadEjecutora::create([
                'institucion_id' => $request->institucion_id,
                'nombre' => $request->nombre,
                'fecha_inicial' => date('Y-m-d', strtotime($request->fecha_inicial_dat)),
                'fecha_final' => date('Y-m-d', strtotime($request->fecha_final_dat)),
                'unidad_ejecutora' => $request->institucion_id,
                'dir_admin_id' => $dir_admin_id,
                'estado' => $estado,

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
