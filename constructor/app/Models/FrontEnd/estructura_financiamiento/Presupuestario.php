<?php

namespace App\Models\FrontEnd\estructura_financiamiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuestario extends Model
{
    use HasFactory;
    protected $fillable = ['id','codigo', 'nombre',  'padre',  'tipo' ];
	protected $table = 'cla_presupuestario';

    public function organismos(){
        return $this->belongsTo(Funcionario::class, 'id', 'users_id');//id es id de usuario y user_id es el foraneo de funcionarios
    }
}
