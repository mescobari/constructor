<?php

namespace App\Http\Controllers\Back_End\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
use App\Models\administracion\spatie\Rol;
use App\Http\Requests\ValidacionPersona;
use App\Http\Requests\ValidacionUsuarioActualizacion;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Models\BackEnd\administracion\parametricas\Parametrica;
use App\Models\BackEnd\intervenciones\ClaInstitucional;
use App\Models\FrontEnd\usuarios\Funcionario;

class personaController extends Controller
{
    public function index()
    {
        $datas = Persona::all(); 
        foreach($datas as $data){
            $expedido = Parametrica::where('id', $data->expedido)->first();
            if(isset($expedido)){
                $data->expedidoLiteral = $expedido->valor;
            }
        }       
        return view('back-end.admin.persona.index', compact('datas'));
    }

    public function crear()
    {
        $generos = Parametrica::where('grupo', 'Genero')->where('estado', 'ACT')->orderBy('valor')->get();
        $extenciones = Parametrica::where('grupo', 'extenciones')->where('estado', 'ACT')->orderBy('valor')->get();
        $instituciones = ClaInstitucional::orderBy('nombre')->get();
        // $roles = Rol::orderBy('id')->get();
        return view('back-end.admin.persona.crear', compact('generos', 'extenciones', 'instituciones'));
    }

    public function guardar(ValidacionPersona $request)
    {
        if(isset($request->estado)){
            $estado = 'ACT';
        }else{
            $estado = 'DES';
        }
        $persona = Persona::create([
            'ci'=>$request->ci,
            'complemento'=>$request->complemento,
            'expedido'=>$request->expedido,
            'nombres'=>$request->nombres,
            'paterno'=>$request->paterno,
            'materno'=>$request->materno,
            'direccion'=>$request->direccion,
            'telefono'=>$request->telefono,
            'celular'=>$request->celular,
            'sexo'=>$request->sexo,
            'fecha_nacimiento'=>$request->fecha_nacimiento,
            'codigo_persona'=>$request->codigo_persona,
        ]);
        // $usuario = User::create([
        //     'userName'=>$request->userName,
        //     'email'=>$request->email,
        //     'password'=>bcrypt($request->password),
        //     'estado'=>$estado,
        // ]);
        // $funcionario = Funcionario::create([
        //     'institucion_id'=>$request->institucion_id,
        //     'persona_id'=>$persona->id,
        //     'users_id'=>$usuario->id,
        //     'fecha_inicial'=>$request->fecha_inicial,
        //     'fecha_final'=>$request->fecha_final,
        // ]);
        return redirect()->route('persona')->with('mensaje', 'Persona creada con exito');
    }


    public function editar($id)
    {
        $generos = Parametrica::where('grupo', 'Genero')->where('estado', 'ACT')->orderBy('valor')->get();
        $extenciones = Parametrica::where('grupo', 'extenciones')->where('estado', 'ACT')->orderBy('valor')->get();        
        $persona = Persona::findOrFail($id);         
        return view('back-end.admin.persona.editar', compact('persona', 'generos', 'extenciones'));
    }


    public function actualizar(Request $request)
    {
        Persona::findOrFail($request->id)->update($request->all());                
        return redirect()->route('persona')->with('mensaje', 'Persona actualizada con exito');
    }

    public function eliminar(Request $request, $id)
    {
        
    }
}
