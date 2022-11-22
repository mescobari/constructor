<?php

namespace App\Http\Controllers\Front_End\Constructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepositorioController extends Controller
{
   
   
    public function inicio()
    {
        return view('front-end.reportes.IndexRepositorio');
    }
   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $arrFiles = array();
       $repo=public_path().'/constructor/constructor';
       $repo=str_replace("\\", "/", $repo);

        $objDir = dir($repo);
        $guion=[];  $under=[];
        while (false !== ($entry = $objDir->read())) {
            $guion=explode('-',$entry);
            $under=explode('_',$entry);

            If (($guion[0]==$id) or ($under[0]==$id)) {
                $entry='constructor/constructor'.'/'.$entry;
                $arrFiles[] = url($entry);
            }
        }
         

        $objDir->close();


        $msg='Aqui estamos en repocontroller show '.$repo;
        return $arrFiles;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
