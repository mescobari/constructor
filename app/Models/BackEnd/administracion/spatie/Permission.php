<?php

namespace App\Models\BackEnd\administracion\spatie;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['id', 'name', 'guard_name', 'descripcion', 'created_at', 'updated_at'];
}
