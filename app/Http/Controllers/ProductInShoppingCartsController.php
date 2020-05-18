<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductInShoppingCart;

class ProductInShoppingCartsController extends Controller
{
    public function __construct()
    {
        //aca le decimos que ejecute el middleware
        $this->middleware('shopping_cart');
    }


    //establecemos de 2 funciones

    //creacions de nuevos registro
    public function store(Request $request)
    {
        //creamos el nuevo registro
        //tiene que tener dos campos el id que esta en el objeto request en el que tenermos el objeto shoping_cart y tenemos el ID
        $in_shopping_cart=ProductInShoppingCart::create([
            'shopping_cart_id'=>$request->shopping_cart->id,
            'product_id'=>$request->product_id

        ]);
        
        //si todo salio bien vamos a redireccionar a la persona hacia la pagina que provenia antes de estar aca
        if($in_shopping_cart){
            return redirect()->back();
        }

        return redirect()->back()->withErrors(['product'=>'No se puede agregar el producto']);


        //ahora vamos a tener el carrito de compras en esta prpiedad shoping_cart del objeto request
       // $request->shopping_cart;
    }


    //eliminacion de registros, no de la bd... sino del carrito
    public function destroy($id){

    }

    //para establecer las rutas que aputan a estas funciones
    //vamo a routes->web.php

}
