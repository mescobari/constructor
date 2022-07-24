<?php

namespace App\Models\FrontEnd\cofinanciadores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $fillable = ['id','docmodulos_id', 'nombre',  'sigla' ];
	protected $table = 'document_types';
}
