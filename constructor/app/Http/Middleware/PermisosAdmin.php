<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class PermisosAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset(auth()->user()->id)){
            $user = User::where('id', auth()->user()->id)->first();
            if($user->hasRole(['super_administrador'])){
                return $next($request);
            }else{
                return redirect()->route('403')->with('mensaje','El usuario no tiene permisos para esta página');
            }
        }         
    }
}
