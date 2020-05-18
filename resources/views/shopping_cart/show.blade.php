@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card padding">
            <header>
                <h2>Mi carrito de compras</h2>
            </header>
            <div class="card-body">
                <!--Aca coloco todos los productos que estan asignados a este carrito de compras-->
                <!--estos productos se pueden obtener del metodo products()-->
                <!--shopping_cart lo recibimos del controlador-->
                <div class="row">
                    <div class="col-12 col-md-6">
                        <products-shopping-component></products-shopping-component>
                    </div>
                    <div class="col-12 col-md-6 payments">
                        <p>Paga tu total facilmente con cualquiera de estos metodos a traves de Paypal</p>
                        <img src="/image/cards.png" alt="" width="120">
                        <img src="/image/paypal.png" alt="" width="120">
                        <div>
                            <a href="/pagar" class="btn btn-primary">Proceder al pago</a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection