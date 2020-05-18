<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
     //
    //se debe de configurar un atributo fillable q debe de contener un arreglo con todos los campos de la tabla que pueden ser asignados en masa
    //estos atributos son los que se esperan que podamos modificar via un formulario
    public $fillable=[
        'title',
        'price',
        'description',
        'image_url'
    ];

    //definimos 2 metodos

    //uno URL que nos va dar hacia donde tengo que hacer la peticion
    public function url()
    {
        //aqui usamos un metodo para saber si el obbjeto en q stoy ya se guado en la bd o no
        //si el id exite la direccion debe ser productos.update y si no existe debe de ser productos.create
        return $this->id ? 'productos.update': 'productos.store';

    }

    public function method()
    {
        //va devolver el metodo http con el q tengo q hacer la peticion
        //PARA ACTUALIZAR ES PUT Y PARA CREAR ES POST
        return $this->id ? 'PUT': 'POST';

    }
}
