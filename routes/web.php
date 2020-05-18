<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

#RUTAS QUE CORRESPONDER AL CONTROLLER REST
Route::resource('productos','ProductsController');#nombre de recurso en plural y el nombre del controlador

Route::resource('in_shopping_carts','ProductInShoppingCartsController',[
    'only'=>['store','destroy']
]);//en el arreglo agregamos una serie de opciones que solo queremos store y destroy, y no create ni show del REST

//va ser una ruta get xk unicamente vamos a consultar
//llamamos al controlador en singular xk unicamente ace referencia a un carrito de compras
Route::get('/carrito','ShoppingCartController@show')->name('shopping_cart.show');
Route::get('/carrito/productos','ShoppingCartController@products')->name('shopping_cart.products');

//solicitud de cobro
Route::get('/pagar','PaymentsController@pay')->name('payments.pay');

Route::get('/pagar/completar','PaymentsController@execute')->name('payments.execute');



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
