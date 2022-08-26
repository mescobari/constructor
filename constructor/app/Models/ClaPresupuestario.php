<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaPresupuestario extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'nombre', 'padre', 'tipo' ];
	protected $table = 'cla_presupuestario';
}
