<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

use App\ShoppingCart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //View::share('productsCount',$shopping_cart->id);
        View::composer('*',function($view){
            //
        //definimos un nombre con el q identificamos la secion del carrito
        $sessionName="shopping_cart_id";
        //vamos a utilizar la clase session
        $shopping_cart_id= \Session::get($sessionName);
        //obtenemos el carrito
        $shopping_cart=ShoppingCart::findOrCreateById($shopping_cart_id);
        //guardamos o actualizamos la sesion del carrito
        \Session::put($sessionName,$shopping_cart->id);

        $view->with('productsCount',$shopping_cart->productsCount());
        });
    }
}
