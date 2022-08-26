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
    public function passes($attribute, $cadena)
    {
        $respuesta = false;
        if(str_contains($cadena, '_permiso_menu')){
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
        return 'Este permiso no se puede modificar, comuniquese con su desarrollador.';
    }
}
