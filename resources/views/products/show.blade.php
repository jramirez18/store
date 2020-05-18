@extends('layouts.app')

@section('content')
<div class="row justify-content-sm-center"><!--FILA, y para que se centre colocamos el justifi-->
    <div class="col-xs-12 col-sm-10 col-md-7 col-lg-6"><!--12 col movil, pantallas grndes 1o, medianans 7, y las mas grandes las de pc con 6--> 
        <div class="card">
            <header class="padding text-center bg-primary">
                <!--aca colocaremos la imagen del elemento-->
            </header>
            <div class="card-body padding">
                <h1 class="card-title">{{$product->title}}</h1>
                <h4 class="card-subtitle">{{$product->price}}</h4>
                <p class="card-text">{{$product->description}}</p>
                <div class="card-actions">
                    <add-product-btn :product='{!! json_encode($product) !!}'></add-product-btn>
                    @include('products.delete')
                </div>

            </div>
        </div>

    </div>
</div>
    
@endsection