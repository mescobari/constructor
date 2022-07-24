<?php

namespace App\Models\FrontEnd\cofinanciadores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaOrganismos extends Model
{
    use HasFactory;
    protected $fillable = ['padre','codigo', 'nombre',  'sigla' ];
	protected $table = 'cla_organismos';
}
