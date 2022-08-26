<?php

namespace App\Models\FrontEnd\intervenciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionType extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];
	protected $table = 'intervention_types';
}


