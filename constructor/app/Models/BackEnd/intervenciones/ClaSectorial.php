<?php

namespace App\Models\BackEnd\intervenciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaSectorial extends Model
{
    use HasFactory;
    protected $fillable = ['sector', 'subsector','tipo', 'denominacion', 'sigla' ];
	protected $table = 'cla_sectorial';
}
