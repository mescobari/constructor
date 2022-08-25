<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\administracion\spatie\Rol;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;

use App\Models\FrontEnd\usuarios\Funcionario;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
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
        $user = User::where('id', auth()->user()->id)->first();
        if($user->hasRole($valor)){
            return true;
        }else{
            return  false;
        }        
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }
    
    public function datos(){
        return $this->belongsTo(Funcionario::class, 'id', 'users_id');//id es id de usuario y user_id es el foraneo de funcionarios
    }
    public function funcionario_user_auth(){
        $respuesta = Funcionario::where('users_id', auth()->user()->id)->first();
        return $respuesta;
    }
    public function institucion_user_auth(){
        $respuesta = ClaInstitucional::where('id', auth()->user()->funcionario_user_auth()->institucion_id)->first();
        return $respuesta;
    }
}
