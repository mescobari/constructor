<?php

namespace App\Models\BackEnd\administracion\usuarios;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\BackEnd\administracion\spatie\Rol;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';
    protected $remember_token = false;
    protected $table = 'users';
    protected $fillable = [
        'userName',
        'token',
        'email',
        'email_verified_at',        
        'password',   
        'estado',   
        'user_create',   
        'updated_at',
        // 'deleted_at',
    ];   
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function check_roles($valor){
        $user = Usuario::where('id', auth()->user()->id)->first();
        if($user->hasRole($valor)){
            return true;
        }else{
            return  false;
        }        
    }
}
