<?php

namespace App\Http\Middleware;

use Closure;

class MDsuperadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
       // $usuario_actual = Auth::user();
        if(auth()->user()->tipo_usuario != 2){
            abort(403, 'Usted no tiene los privilegios para acceder a esta página.');
        }
        return $next($request);
    }
}
