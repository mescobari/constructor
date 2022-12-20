<?php

namespace App\Http\Controllers\Front_End\Constructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackEnd\administracion\menu\Menu;

use App\Models\Constructor\Estructura;
use App\Models\Constructor\Document;
use App\Models\FrontEnd\usuarios\Funcionario;
use App\Models\Responsables;

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

       
        
        $contrato_id = session('contrato_id');
        $nombre = Document::find($contrato_id)->nombre;
        session(['nombre' => $nombre]);
        $menus = Estructura::getMenu(true, false);
        return view('Front-end.constructor.estructura', compact('menus', 'contrato_id', 'nombre'));
        
      
    }

    public function estructura()
    {
        $users_id = auth()->user()->id;
       
        if ($users_id > 2) {
            // obtenemo ahora el funcionario_id
            $funcionario_id = Funcionario::find($users_id)->id;
           
            // ahora debemos encontrar el id del responsable, un funcionario puede estar asignado a mas de un proyecto.
            $resp = Responsables::select('documents_id')->where('funcionario_id', '=', $funcionario_id)->get()->toarray();

            $contratos= document::whereIn('id', $resp) ->orWhereIn('padre', $resp)->get();
        } else {
            $contratos= document::all();
        }

        // tambien debemos obtener el nombre  del contrato
        //session(['contrato_id' => $contrato_id]);

        return view('Front-end.constructor.selectContrato', compact('contratos'));

    }

    public function sescontrato($contrato_id)
    {
        

        // tambien debemos obtener el nombre  del contrato
        session(['contrato_id' => $contrato_id]);
       

        return 'ok lo logramos  '. $contrato_id;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $nombre = session('nombre');

        return view('back-end.admin.avan.crear', compact('nombre'));
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
       /* $permiso = Permission::create([
            'name'=>str_replace(" ", "_", strtolower($request->nombre) . "_permiso_avan"),
            'guard_name'=>'web',
            'descripcion'=> '(' . strtoupper($request->nombre) . '), ' . $request->descripcion . ", para el Menú",
        ]);

        $request['id_permission'] = $permiso->id;*/

        $request['user_create'] = auth()->user()->id;
        $request['estado'] = $estado;
        $request['contrato_id'] = session('contrato_id');

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
