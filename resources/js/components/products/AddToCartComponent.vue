<template>
  <button @click="addToCart" class="btn btn-primary">{{message}}</button>
</template>

<script>
export default {
  data() {
    return {
      message: "Agregar al carrito",
      endpoint: "/in_shopping_carts"
    };
  },

  props: { product: { type: Object } },

  methods: {
    addToCart() {
      //hacemos lapeticion ajax, se trata de POST
      axios({
        method: "POST",
        url: this.endpoint,
        data: {
          //aca colocamos los elemento que quieren que se miren
          product_id: this.product.id
        },
        //adicional agrego un par de encabezados que le indiquen al server que estamos en busca de json
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json"
        }
      }).then(() => {
        //despues que termine la peticion ajax actualice el almacenamiento global
        window.store.commit("increment"); //increment nombre de la mutacion

        //console.log("Se agrego el producto");
      });
    }
  }
};
</script>