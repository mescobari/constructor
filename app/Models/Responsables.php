<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsables extends Model
{
    use HasFactory;
    protected $fillable = ['intervenciones_id', 'funcionario_id', 'fecha_inicial', 'fecha_final', 'motivo' ];
	protected $table = 'intervenciones_funcionarios';
}

