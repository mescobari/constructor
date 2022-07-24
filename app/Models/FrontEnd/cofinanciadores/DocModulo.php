<?php

namespace App\Models\FrontEnd\cofinanciadores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocModulo extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre', 'sigla' ];
	protected $table = 'docmodulos';
}
