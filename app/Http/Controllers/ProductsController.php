<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ShoppingCart;
use App\Http\Resources\ProductsCollection;

class ProductsController extends Controller
{
    public function __construct()
    {
        //aqui especificamo los midelwares que nos ayudaran a proteger nuestras rutas
        //este middleware no lo programamos viene ya con laravel
        $this->middleware('auth',['except'=>['index','show']]);//si solo colocaos el auth se nos restringe todo 
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
         //obtener todos los productos
         $products=Product::paginate(15);
        //vamos a utilizar un metodo que es parte de $request
         if($request->wantsJson())//este metodo devuleve verdadero cuando se interpreta que el cliente necesita este tipo de datos del servidor
         {
             return new ProductsCollection($products);
         }
         
         return view('products.index',['products'=>$products]);//[nombre de la variable, datos que va contener dicha variable]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         //creamos la variable product para pasarlo a la vista create
         $product= new Product;//le enviamos un objeto vacio
         //create lo envia a store para que lo guarde en la BD
         return view('products.create',["product"=>$product]);//nombre de la carpeta.y nombre del archivo
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //aca se almacena en la BD

        //creamos un arreglo con todas las configuraciones del producto
        $options=[
            'title'=>$request->title,
            'price'=>$request->price,
            'description'=>$request->description
        ];

        //ahora tenemos que crear el producto
        if(Product::create($options))
        {
            return redirect('/productos');

        }else{
            return view('products.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //Mustra un Recurso
        $product=Product::find($id);

        return view('products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //obtenemos el productos que se va modificar
        $product=Product::find($id);
        //retornamos una vista 
        return view('products.edit',['product'=>$product]);//necesitamos enviar el controlador a la vista
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         //ACTUALIZAR
        //primero obtenemos el producto que vamos a actualizar
        $product=Product::find($id);
        //despues asignamos los nuevos valores
        $product->title=$request->title;
        $product->price=$request->price;
        $product->description=$request->description;
        //esta modificaciones van a la memoria virtual y 
        //para reflejar estos cambios mandamos a llamar al metodo SAVE

        //despues para guardar estos cambios en la BD
        if ($product->save()) {//hace una consulta de actualizacion a la bd
            # code...
            //si todo sale bien nos redirecciona a la vista de HOME
            return redirect('/');

        }else{
            //si no que vuelva a mostrar la misma vista de edicion
            return view('products.edit',['product'=>$product]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //Elimina un recurso
        //el modelo tiene un metodo DESTROY, al que le enviamos un id
        Product::destroy($id);
        return redirect('/productos');
    }
}
