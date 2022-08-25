<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalizacionIntervencion extends Model
{
    use HasFactory;
	protected $table = 'localizacion_intervencion';
    protected $fillable = ['id', 'localizaciones_id', 'intervenciones_id'];
}
