<?php

namespace App\Http\Controllers\Front_End\Constructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\administracion\menu\Menu;
use App\Models\Constructor\Estructura;
use App\Http\Requests\ValidacionMenu;
use App\Http\Requests\ValidacionMenuActualizar;
use Spatie\Permission\Models\Permission;

class AvanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['actividad_menu' => '2']);
        $menus = Estructura::getMenu(true, false);
        return view('Front-end.constructor.estructura', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {

        return view('back-end.admin.avan.crear');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(ValidacionMenu $request)
    {
        if(isset($request->estado)){
            $estado = 'ACT';
        }else{
            $estado = 'DES';
        }
        $permiso = Permission::create([
            'name'=>str_replace(" ", "_", strtolower($request->nombre) . "_permiso_menu"),
            'guard_name'=>'web',
            'descripcion'=> '(' . strtoupper($request->nombre) . '), ' . $request->descripcion . ", para el Menú",
        ]);
        $request['id_permission'] = $permiso->id;
        $request['user_create'] = auth()->user()->id;
        $request['estado'] = $estado;

        Estructura::create($request->all());

        $menus = Estructura::getMenu();
        // return view('back-end.admin.menu.index', compact('menus'));

        return redirect()->route('crear_avan')->with('mensaje', 'Item creado con exito');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $data = Estructura::findOrFail($id);

        return view('back-end.admin.avan.editar', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(ValidacionMenuActualizar $request )
    {
        if(isset($request->estado)){
            $request['estado'] = 'ACT';
        }else{
            $request['estado'] = 'DES';
        }
        $menu = Estructura::select('id_permission')->where('id', $request->id_menu)->first();
        // $permiso = Permission::where('id', $menu->id_permission)->first();
        Permission::findOrFail($menu->id_permission)->update([
            'descripcion'=> '(' . strtoupper($request->nombre) . '), ' . $request->descripcion . ", para la Estructura",
        ]);

        Estructura::findOrFail($request->id_menu)->update($request->all());
        return redirect()->route('avan')->with('mensaje', 'Estructura actualizada con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Estructura::destroy($id);

        return redirect()->route('avan')->with('mensaje', 'Item eliminado con exito');

    }

    public function guardarOrden(Request $request)
    {
        // return ($request->menu);
        if ($request->ajax()) {
            $menu = new Estructura;
            $menu->guardarOrden($request->menu);
            return response()->json(['respuesta' => 'ok en teoria']);
        } else {
            abort(404);
        }
    }
}