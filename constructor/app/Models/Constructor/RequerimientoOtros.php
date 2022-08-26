<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequerimientoOtros extends Model
{
    use HasFactory;
    protected $fillable = [
        'requerimiento_id',
        'requerimiento_recurso_id',
        'cantidad_otros',
        'monto_otros',
        'explicar_otros',
    ];
}
