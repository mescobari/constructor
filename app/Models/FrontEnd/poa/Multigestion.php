<?php

namespace App\Models\FrontEnd\Poa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multigestion extends Model
{
    use HasFactory;
    protected $fillable = ['id','intervenciones_id', 'gestion',  'continuidad',  'mml_id',  'poa_id' ];
	protected $table = 'multigestion';

}
