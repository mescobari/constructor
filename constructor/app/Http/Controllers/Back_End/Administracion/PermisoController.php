<?php

namespace App\Http\Controllers\Back_End\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\administracion\spatie\Permission;
use App\Http\Requests\ValidarPermiso;

use Spatie\Permission\Models\Role;
class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Permission::orderBy('id')->get();
        return view('back-end.admin.permiso.index', compact('datas'));
    }

    public function ver(Request $request){
        $role = Role::where('id', $request->id_rol)->first();
        // $role = $role->hasAnyPermission('fer');
        $datas = Permission::orderBy('id')->get();
        foreach($datas as $data){
            if($role->hasAnyPermission($data->name)){
                $data->rol = true;
            }else{
                $data->rol = false;
            }
        }
        return $datas;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        return view('back-end.admin.permiso.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidarPermiso $request)
    {
        $request->guard_name = 'web';
        Permission::create([
            'name'=>$request->name,
            'guard_name'=>'web',
            'descripcion'=>$request->descripcion
        ]);
        return redirect()->route('crear_permiso')->with('mensaje', 'Permiso creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Permission::findOrFail($id);
        return view('back-end.admin.permiso.editar', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidarPermiso $request, $id)
    {
        $permiso = Permission::where('id', $id)->first();
        if(str_contains($permiso['name'], '_permiso_menu')){
            return redirect()->route('permiso')->with('errorf', 'Este permiso no es modificable, comuniquese con su desarrollador');    
        }
        Permission::findOrFail($id)->update($request->all());
        return redirect()->route('permiso')->with('mensaje', 'Permiso actualizado con exito');
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
            if (Permission::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
