<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    //
    public static function findOrCreateById($shopping_car_id)
    {
        //si este id es un valor true, vamos a tratar de buscar un carrito con este id
        if($shopping_car_id){
            return ShoppingCart::find($shopping_car_id);
        }else{
            //si no existe crea uno nuevo
            return ShoppingCart::create();
        }

    }

    //para obtener todos los productos creamos un metodo
    public function products()
    {
        return $this->belongsToMany('App\Product','product_in_shopping_carts');
    }

    //a partir de metodo products podemos crear las consultas
    public function productsCount()
    {
       return $this->products()->count();
    }


    //metodo de paypal
    public function amount(){
        return $this->products()->sum("price") / 100;


    }

    public function amountInCents(){
        return $this->products()->sum("price");
      }
  
}
