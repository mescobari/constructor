<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoObjetivo extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'objetivo', 'resultado', 'padre', 'descripcion' ];
	protected $table = 'objetive_types';
}
