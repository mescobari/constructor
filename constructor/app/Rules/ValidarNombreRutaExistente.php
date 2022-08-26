<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Route;

class ValidarNombreRutaExistente implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $NombreRuta)
    {
        $respuesta = false;
        $routeCollection = Route::getRoutes()->getRoutesByName();
        $nombres_rutas = array();
        foreach ($routeCollection as $key=>$value) {           
            array_push($nombres_rutas, [$key]);
        }
        $cont = 0;
        foreach($nombres_rutas as $nombre_ruta){
            if(trim($nombre_ruta[0]) == trim($NombreRuta)){
                $cont++;
            }
        }        
        if($cont > 0){
            $respuesta = true;
        }
        return $respuesta;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este nombre de ruta no existe en nuestros registros.';
    }
}
