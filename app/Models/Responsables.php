<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsables extends Model
{
    use HasFactory;
    protected $fillable = ['funcionario_id','unidad_ejecutora_id','documents_id', 'fecha_inicial', 'fecha_final', 'motivo' ];
	protected $table = 'funcionario_proyectos';
}

