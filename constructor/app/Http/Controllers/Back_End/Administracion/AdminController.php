<?php

namespace App\Http\Controllers\Back_End\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.admin.index');
    }


}
