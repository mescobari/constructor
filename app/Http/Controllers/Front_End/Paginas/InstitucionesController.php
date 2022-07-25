<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\User;
use App\Models\FrontEnd\intervenciones\Intervencion;

class InstitucionesController extends Controller
{
    public function institucionesActivas(){
        $data = ClaInstitucional::all();
        return $data;
    }
    public function institucionesActivasSinPadre(){
        $data = ClaInstitucional::where('codigo','<>', '0')->get();
        return $data;
    }
    public function institucionesIntervencion(){
        $institucion_id=auth()->user()->funcionario_user_auth()->institucion_id;
       
        $data = ClaInstitucional::where('id', auth()->user()->funcionario_user_auth()->institucion_id)->get();
        return $data;
    }

    public function index()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show(ClaInstitucional $instituciones)
    {
        //
    }
    public function update(Request $request, ClaInstitucional $instituciones)
    {
        //
    }
    public function destroy($id)
    {
        //
    }    

    public function proyectos_de_institucion(){
        $respuestaUser = User::where('id', auth()->user()->id)->with('datos')->get();//me va dar el id de institucion
        $respuestaInstitucion = Intervencion::where('institucion_id', $respuestaUser[0]->datos->institucion_id)->get();//me va dar los proyectos de la institucion
        $respuestaDatosInstitucion = ClaInstitucional::where('id', $respuestaUser[0]->datos->institucion_id)->first();//me va dar los datos de la institucion
        $cont = 0;
        foreach($respuestaInstitucion as $val){
            $cont++;
        }    
        $respuesta = ['proyectos'=>$respuestaInstitucion, 'cantidad'=>$cont, 'institucion' => $respuestaDatosInstitucion];    
        return $respuesta;
    }
}
