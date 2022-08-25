<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequerimientoRelacion extends Model
{
    use HasFactory;
    protected $fillable = ['requerimiento_id', 'planilla_item_id', 'vigente','avance', 
    'estimado', 'precio_unitario'];

   protected $table = 'requerimiento_relaciones';
}
