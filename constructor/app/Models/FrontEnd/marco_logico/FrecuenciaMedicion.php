<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrecuenciaMedicion extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nombre', 'sigla' ];
	protected $table = 'indicador_frecuencia';
}
