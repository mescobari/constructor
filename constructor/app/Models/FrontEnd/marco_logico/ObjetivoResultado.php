<?php

namespace App\Models\FrontEnd\marco_logico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoResultado extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'objetivos_id', 'resultados_id' ];
	protected $table = 'objetivos_resultados';
}
