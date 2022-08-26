<?php

namespace App\Http\Controllers\Front_End\Paginas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEnd\intervenciones\ClaSectorial;

class SectorialController extends Controller
{
    public function sectorialesActivas(){
        $data = ClaSectorial::where('sector','<>','0')->where('subsector','<>','0')->where('tipo','<>','0')->get();
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
