@auth
    <!--ABRIMOS UN NUEVO FORMULARIO-->
<!--METODO DELETE...RUTA A LA CUAL TIENE QUE ENVIARSE (NOMBRE DE LA RUTA, Y EL ID DEL ELEMENTO)...-->
{!! Form::open(['method'=>'DELETE','route'=>['productos.destroy',$product->id],'onsubmit'=>'return confirm("¿Estas seguro de elimiar este registro?")']) !!}
<input type="submit" value="Eliminar producto" class="btn btn-danger">
{!! Form::close() !!}

<!--despues importamos este formulario donde queramos el control que va eliminarlo--> 
@endauth <!--Con auth indicamos que el boton unicamente se muestre cuando este autenticado el usuario-->

<!--El inverso de auth es la directiva GUEST, este muestra la info si el usuario no ha iniciado secion-->
