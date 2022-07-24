<?php

namespace App\Models\BackEnd\intervenciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaInstitucional extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'nombre', 'denominacion', 'sigla' ];
	protected $table = 'cla_institucional';
}
