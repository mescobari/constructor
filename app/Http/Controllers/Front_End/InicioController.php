<?php

namespace App\Http\Controllers\Front_End;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        return view('inicio');
    }
    public function invitado()
    {
        return view('front-end.inicio-invitado');
    }
    public function tabla()
    {
        return view('front-end.inicio-prueba');
    }
    public function error_404(){
        return view('errores.404');
    }
    public function error_403(){
        return view('errores.403');
    }

    public function error_2505(){
        return view('errores.UserInectivate');
    }
}
