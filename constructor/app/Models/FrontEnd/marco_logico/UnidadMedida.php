<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nombre', 'simbolo', 'descripcion' ];
	protected $table = 'unidades';
}
