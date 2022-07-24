<?php

namespace App\Http\Controllers\Back_End\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionRol;
use App\Models\BackEnd\administracion\spatie\Rol;
// use App\Models\administracion\spatie\Permission;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Rol::orderBy('id')->get();
        return view('back-end.admin.rol.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('back-end.admin.rol.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        Rol::create([
            'name'=>trim($request->name),
            'guard_name'=>'web',
            'descripcion'=> $request->descripcion,
        ]);
        return redirect('roles/rol')->with('mensaje', 'Rol creado con exito');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Rol::findOrFail($id);
        return view('back-end.admin.rol.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionRol $request, $id)
    {
        $rol = Rol::where('id', $id)->first();
        if(str_contains($rol['name'], 'super_administrador') || str_contains($rol['name'], 'administrador')){
            return redirect()->route('rol')->with('mensaje', 'Este rol no es modificable, comuniquese con su desarrollador');    
        }
        Rol::findOrFail($id)->update($request->all());
        return redirect()->route('rol')->with('mensaje', 'Rol actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Rol::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }

    public function actualizar_permisos_rol(Request $request){
        
        $role = Role::where('id', $request->id_rol)->first();
        if(!isset($request->asigna)){
            $request->asigna = [];
        }
        $permissions = Permission::select('name')->whereIn('id', $request->asigna)->get()->toArray();
        if(isset($request->asigna)){
            $role->syncPermissions($permissions);
        }
        return redirect()->route('rol');
    }
}
