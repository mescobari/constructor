<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioActivadoMiddleware
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
            $user = User::where('id', auth()->user()->id)->where('estado','ACT')->first();
            if(!isset($user->id)){
                return redirect()->route('usuario_inactivado')->with('mensaje','El usuario fue desactivado en fecha: ' . auth()->user()->updated_at);
            }else{
                return $next($request);
            }
        } 
    }
}
