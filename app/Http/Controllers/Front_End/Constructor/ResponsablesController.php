<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use App\Models\Responsables;
use App\Models\Persona;
use App\Models\User;
use App\Models\FrontEnd\usuarios\Funcionario;


class ResponsablesController extends Controller
{
    
    public function inicio()
    {
        return view('front-end.paginas.IndexResponsable');
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $responsable = new Responsables;

        $responsable->funcionario_id = $request->funcionario_id;
        $responsable->unidad_ejecutora_id = $request->unidad_ejecutora_id;
        $responsable->documents_id = $request->documents_id;
        $responsable->fecha_inicial = $request->fecha_inicial;
        $responsable->fecha_final = $request->fecha_final;
        $responsable->motivo = $request->motivo;
        
        $responsable->save();
        
        $respuesta = 'Responsable successfully created';
        return $respuesta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $resp = Responsables::find($id);

        $resp->delete();

        
        return $resp;
    }

    public function funcionarios(){
        $respuesta = Funcionario::where('locationtype_id', 1)->get();
        return $respuesta;
    }

    public function funcionarios_de_institucion(){
        $respuestaUser = User::where('id', auth()->user()->id)->with('datos')->get();//me va dar el id de institucion
        $respuestaInstitucion = Funcionario::where('institucion_id', $respuestaUser[0]->datos->institucion_id)->get();//me va dar los funcionarios de la institucion
               
        $personas = Persona::join("funcionarios","funcionarios.persona_id","=","personas.id")
            ->where('funcionarios.institucion_id','=',$respuestaUser[0]->datos->institucion_id)
            ->get();
        
        $cont = 0;
        foreach($respuestaInstitucion as $val){
            $cont++;
        }    
        //$respuesta = ['funcionarios'=>$personas, 'cantidad'=>$cont]; 
        foreach($personas as $val){
            $val['nombresAP'] = $val->nombres . ' ' . $val->paterno . ' ' . $val->materno;
        }    

        $respuesta = $personas;
        return $respuesta;
    }

    public function buscar_responsables(Request $request){

       
        $institucion_id=$request->institucion_id;
        
       
$respuesta = DB::table('funcionario_proyectos')
            ->join('funcionarios', 'funcionario_proyectos.funcionario_id', '=', 'funcionarios.id')
            ->join('personas', 'funcionarios.persona_id', '=', 'personas.id')
            ->join('documents', 'funcionario_proyectos.documents_id', '=', 'documents.id')
            ->join('unidades_ejecutoras', 'funcionario_proyectos.unidad_ejecutora_id', '=', 'unidades_ejecutoras.id')
            ->where('funcionarios.institucion_id','=',$institucion_id)
            ->select(  DB::raw('CONCAT(personas.nombres, " ", personas.paterno, " " , personas.paterno) as persona') , 
            'documents.nombre as contrato', 'unidades_ejecutoras.nombre as uni_eje', 
            DB::raw('date_format(funcionario_proyectos.fecha_inicial, "%d-%m-%Y") as fecha_inicial'),
            DB::raw('date_format(funcionario_proyectos.fecha_final, "%d-%m-%Y") as fecha_final'),
            'funcionario_proyectos.motivo','funcionario_proyectos.id')
            ->get();


        //$respuesta = 'estamos listos '. $institucion_id;
        return $respuesta;
    }    
    
}
