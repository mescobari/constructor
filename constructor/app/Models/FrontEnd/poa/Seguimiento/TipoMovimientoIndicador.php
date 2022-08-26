<?php

namespace App\Models\FrontEnd\Poa\Seguimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimientoIndicador extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nombre', 'sigla' ];
	protected $table = 'move_indicator_types';
}
