<?php

namespace App\Http\Controllers\Front_End\Paginas;

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
       
        $responsable->intervenciones_id = $request->intervenciones_id;
        $responsable->funcionarios_id = $request->funcionarios_id;
        $responsable->fecha_inicial = $request->fecha_inicial;
        $responsable->fecha_final = $request->fecha_final;
        $responsable->motivo = $request->motivo;

       // $responsable->save($request->all());
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

       
        $intervenciones_id=$request->proyecto['id'];
        
        /*
        $respuesta = DB::raw("SELECT r.id, r.fecha_inicial, r.fecha_final, r.motivo, p.nombres, p.paterno, p.materno 
       FROM intervenciones_funcionarios r, funcionarios f, personas p 
        where r.funcionarios_id=f.id and f.persona_id= p.id and r.intervenciones_id=$intervenciones_id");
*/
$respuesta = DB::table('intervenciones_funcionarios')
            ->join('funcionarios', 'intervenciones_funcionarios.funcionarios_id', '=', 'funcionarios.id')
            ->join('personas', 'funcionarios.persona_id', '=', 'personas.id')
            ->where('intervenciones_funcionarios.intervenciones_id','=',$intervenciones_id)
            ->select('intervenciones_funcionarios.*', 'personas.nombres', 'personas.paterno', 'personas.materno')
            ->get();


        //$respuesta = 'estamos listos '. $intervenciones_id;
        return $respuesta;
    }    
    
}
