<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionDolar extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'valor_venta', 'valor_compra' ];
	protected $table = 'cotizacion_dolar';
}
