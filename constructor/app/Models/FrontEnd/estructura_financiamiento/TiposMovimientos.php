<?php

namespace App\Models\FrontEnd\estructura_financiamiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposMovimientos extends Model
{
    use HasFactory;
    protected $fillable = ['id','nombre', 'sigla' ];
	protected $table = 'move_financial_types';

}
