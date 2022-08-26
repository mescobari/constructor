<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidarCampoUrl;
use App\Rules\ValidarNombreRutaExistente;

class ValidacionMenu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:50|unique:menus,nombre',
            'link_url' => ['required', 'max:100', new ValidarNombreRutaExistente],
            'icon_logo' => 'nullable|max:50',            
        ];
    }
    /*
            'link_url' => ['required', 'max:100', new ValidarCampoUrl], */
}
