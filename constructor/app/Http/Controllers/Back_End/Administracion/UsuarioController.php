<?php

namespace App\Http\Controllers\Back_End\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
use App\Models\administracion\spatie\Rol;
use App\Http\Requests\ValidacionUsuario;
use App\Http\Requests\ValidacionUsuarioActualizacion;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Models\BackEnd\administracion\parametricas\Parametrica;
use App\Models\BackEnd\intervenciones\ClaInstitucional;
use App\Models\FrontEnd\usuarios\Funcionario;

class UsuarioController extends Controller
{
    public function index()
    {
        $id_user = auth()->user()->id;
        $user = User::where('id', $id_user)->first();
        if($user->hasRole(['administrador', 'super_administrador'])){
            $datas = User::all();
        }else{
            $datas = User::where('id', $id_user)->get();
        }   
        foreach($datas as $data){
            $estado = Parametrica::where('codigo', $data->estado)->where('grupo', 'Estados')->where('estado', 'ACT')->first();
            if(isset($estado)){
                $data->estadoLiteral = $estado->valor;
            }
        }
        return view('back-end.admin.usuario.index', compact('datas'));
    }

    public function crear()
    {
        $generos = Parametrica::where('grupo', 'Genero')->where('estado', 'ACT')->orderBy('valor')->get();
        $extenciones = Parametrica::where('grupo', 'extenciones')->where('estado', 'ACT')->orderBy('valor')->get();
        $instituciones = ClaInstitucional::orderBy('nombre')->get();
        $personas = Persona::all();
        return view('back-end.admin.usuario.crear', compact('generos', 'extenciones', 'instituciones', 'personas'));
    }

    public function guardar(ValidacionUsuario $request)
    {
        if(isset($request->estado)){
            $estado = 'ACT';
        }else{
            $estado = 'DES';
        }
        // $persona = Persona::create([
        //     'ci'=>$request->ci,
        //     'complemento'=>$request->complemento,
        //     'expedido'=>$request->expedido,
        //     'nombres'=>$request->nombres,
        //     'paterno'=>$request->paterno,
        //     'materno'=>$request->materno,
        //     'direccion'=>$request->direccion,
        //     'telefono'=>$request->telefono,
        //     'celular'=>$request->celular,
        //     'sexo'=>$request->sexo,
        //     'fecha_nacimiento'=>$request->fecha_nacimiento,
        //     'codigo_persona'=>$request->codigo_persona,
        // ]);
        $usuario = User::create([
            'userName'=>$request->userName,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'estado'=>$estado,
        ]);
        $funcionario = Funcionario::create([
            'institucion_id'=>$request->institucion_id,
            'persona_id'=>$request->persona_id,
            'users_id'=>$usuario->id,
            'fecha_inicial'=>$request->fecha_inicial,
            'fecha_final'=>$request->fecha_final,
        ]);
        return redirect()->route('usuario')->with('mensaje', 'Usuario creado con exito');
    }


    public function editar($id)
    {
        $generos = Parametrica::where('grupo', 'Genero')->where('estado', 'ACT')->orderBy('valor')->get();
        $extenciones = Parametrica::where('grupo', 'extenciones')->where('estado', 'ACT')->orderBy('valor')->get();
        $instituciones = ClaInstitucional::orderBy('nombre')->get();
        $usuario = User::findOrFail($id);        
        $funcionario = Funcionario::where('users_id', $usuario->id)->first();
        $personas = Persona::all();
        $persona = Persona::where('id', $funcionario->persona_id)->first();
        $permisos = $usuario->getPermissionNames();
        $roles = $usuario->getRoleNames();
        
        return view('back-end.admin.usuario.editar', compact('usuario', 'funcionario', 'persona', 'personas', 'roles', 'permisos', 'generos', 'extenciones', 'instituciones'));
    }


    public function actualizar(ValidacionUsuarioActualizacion $request)
    {
        if(isset($request->estado)){
            $estado = 'ACT';
        }else{
            $estado = 'DES';
        }
        $usuario = User::findOrFail($request->id);
        if(trim($request->password) == '' || !isset($request->password)){            
            $usuario->update([
                'userName'=>$request->userName,
                'email'=>$request->email,
                'estado'=>$estado,
            ]);           
        }else{            
            $usuario->update([
                'userName'=>$request->userName,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'estado'=>$estado,
            ]);
        }
        $funcionario = Funcionario::where('users_id', $request->id)->first();
        $funcionario->update([
            'institucion_id'=>$request->institucion_id,
            'persona_id'=>$request->persona_id,
            'users_id'=>$usuario->id,
            'fecha_inicial'=>$request->fecha_inicial,
            'fecha_final'=>$request->fecha_final,
        ]);
        // $usuario->roles()->sync($request->roles);
        return redirect()->route('usuario')->with('mensaje', 'Usuario actualizado con exito');
    }

    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            $usuario = User::findOrFail($id);
            // $usuario->roles()->detach();
            // $usuario->delete();
            if($request->estado == 'ACT'){
                $usuario->update(['estado'=>'DES']);
            }else{
                if($request->estado == 'DES'){
                    $usuario->update(['estado'=>'ACT']);
                }
            }            
            return response()->json(['mensaje' => 'ok']);
         } else {
            abort(404);
        }
    }
    public function actualizar_permisos_ver(Request $request){
        $user = User::where('id', $request->id_usuario)->first();
        // $role = Role::where('id',1)->first();
        // $role = $role->getPermissionNames();
        // return $role;
        // return $user->getPermissionNames();
        $datas = Permission::orderBy('id')->get();
        
        foreach($datas as $data){
            if($user->hasPermissionTo($data->name)){
                $data->rol = true;
            }else{
                $data->rol = false;
            }
        }
        return $datas;
    }
    public function actualizar_roles_ver(Request $request){
        // return "fer";
        $user = User::where('id', $request->id_usuario)->first();
        // $role = Role::where('id',1)->first();
        // $role = $role->getPermissionNames();
        // return $role;
        // return $user->getPermissionNames();
        $datas = Role::orderBy('id')->get();        
        foreach($datas as $data){
            if($user->hasRole($data->name)){
                $data->rol = true;
            }else{
                $data->rol = false;
            }
        }
        return $datas;
    }
    public function actualizar_permisos_usuario(Request $request){
        $user = User::where('id', $request->id_usuario)->first();
        if(!isset($request->asigna_permiso)){
            $request->asigna_permiso = [];
        }
        $permissions = Permission::select('name')->whereIn('id', $request->asigna_permiso)->get()->toArray();
        if(isset($request->asigna_permiso)){
            $user->syncPermissions($permissions);

        }
        return redirect()->route('usuario')->with('mensaje', 'Usuario-Permiso actualizado con exito');
    }
    public function actualizar_roles_usuario(Request $request){
        $user = User::where('id', $request->id_usuario2)->first();
        if(!isset($request->asigna_rol)){
            $request->asigna_rol = [];
        }
        $roles = Role::select('name')->whereIn('id', $request->asigna_rol)->get()->toArray();
        if(isset($request->asigna_rol)){
            $user->syncRoles($roles);
        }   
        return redirect()->route('usuario')->with('mensaje', 'Usuario-Permiso actualizado con exito');
    }
    public function perfil(){        
        $datas = User::where('id', auth()->user()->id)->get();        
        foreach($datas as $data){
            $estado = Parametrica::where('codigo', $data->estado)->where('grupo', 'Estados')->where('estado', 'ACT')->first();
            if(isset($estado)){
                $data->estadoLiteral = $estado->valor;
            }
        }
        return view('back-end.admin.usuario.index', compact('datas'));
    }
}
