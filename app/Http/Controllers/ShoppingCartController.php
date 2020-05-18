<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ProductsCollection;

class ShoppingCartController extends Controller
{
    //
    public function __construct(){
        //obtener el carrito es muy solo tenemos que ejecutar el middleware 
        $this->middleware('shopping_cart');//shopping_cart=asigna a una variable del objeto request el carrito de compras que le pertenece a dicha secion
    }

    public function show(Request $request)//inyecta el objeto request
    {
        return view('shopping_cart.show',['shopping_cart'=>$request->shopping_cart]);
    }

    //creamos esta funcion que va devolver un arreglo en json de los productos que estan en este carrito
    public function products(Request $request)
    {
        return new ProductsCollection($request->shopping_cart->products()->get());

    }
}
