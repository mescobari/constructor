<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Models\Constructor\Requerimiento;

use App\Http\Controllers\Controller;
use App\Models\Constructor\RequerimientoRecursos;
use Illuminate\Http\Request;

class RequerimientoController extends Controller
{


    public function getRequerimientos($id)
    {
        return Requerimiento::find($id);
    }
    public function inicio()
    {
        return view('front-end.constructor.IndexRequerimientos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Requerimiento[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return RequerimientoRecursos::all();
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constructor\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constructor\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constructor\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constructor\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requerimiento $requerimiento)
    {
        //
    }
}
