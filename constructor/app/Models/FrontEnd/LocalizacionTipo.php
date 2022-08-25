<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalizacionTipo extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nombre'];
	protected $table = 'location_types';
}
