<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    use HasFactory;
    protected $fillable = ['codigo', 'nombre','locationtype_id', 'padre' ];
	protected $table = 'localizacion';
}
