<?php

namespace App\Models\BackEnd\administracion\spatie;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";
    protected $fillable = ['id', 'name', 'guard_name', 'descripcion', 'created_at', 'updated_at'];
}
