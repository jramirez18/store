<?php

namespace App\Http\Middleware;

use Closure;

use App\ShoppingCart;

class SetShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {//ESTO VIENE DE AppServiceProvider

        //definimos un nombre con el q identificamos la secion del carrito
        $sessionName="shopping_cart_id";
        //vamos a utilizar la clase session
        $shopping_cart_id= \Session::get($sessionName);
        //obtenemos el carrito
        $shopping_cart=ShoppingCart::findOrCreateById($shopping_cart_id);
        //guardamos o actualizamos la sesion del carrito
        \Session::put($sessionName,$shopping_cart->id);


        $request->shopping_cart=$shopping_cart;

        return $next($request);
    }
}
