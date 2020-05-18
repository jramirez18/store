<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use Illuminate\Support\Facades\Auth;


class ValidateFirstUserSignUp
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
        //cuento la cantidad de usuarios que tengo registrados
        $usersCount=User::count();
        //si el conteo es mayor a cero se qye antes ya se habia registrado al menos un user
        //significa que el middlaware va validar q si no hay no ningun user en la bd, va permitir al primero registrarse aunq no exitsta uuna secion
         //y  a partir del segundo todos deven de resgistrarse con una secion previa
         //de manera que solo usuarios que ya tengan una cuentan puedan crear nuevos
        if($usersCount>0 && Auth::check())
        {
            return redirect('/');
        }

        //llamomos next cuando todo en el middleware salio mal o una respuesta
        return $next($request);
    }
}
