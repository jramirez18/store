@extends('layouts.app')


@section('content')
<div class="container">
    <div class="">
        <products-component></products-component>
    </div>
 
    <div class="actions text-center">
        {{$products->links()}} <!--llamamos al objeto products de index y llamamos al metodo links para la paginacion-->
    </div>
</div>
@endsection