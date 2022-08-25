<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\intervenciones\InterventionType;

class TipoIntervencionesController extends Controller
{
    public function intervencionesTipoActivas(){
        $data = InterventionType::all();
        // $datas = [];
        // $datas[0] = ['create_at' => null, 'updated_at'  => null, 'id' => 0, 'nombre' => 'Seleccione un valor'];
        // foreach($data as $dat){
        //     array_push($datas, $dat);
        // }
        // $data = $datas;
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
    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
