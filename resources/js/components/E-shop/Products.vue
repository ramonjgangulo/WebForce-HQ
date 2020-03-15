<template>
        <v-container
            class="mt-12"

        >
            <v-row class="mt-12">
                <p>All products</p>
            </v-row>
            <v-divider></v-divider>
            <v-row justify="center">
                <v-col
                    v-bind:key="product.id"
                    v-for="product in products"
                    class="col-md-4 col-sm-10"
                >
                    <Product v-bind:product="product"></Product>
                </v-col>
            </v-row>
        </v-container>
</template>

<script>
    import Product from "./Product";
    import axiosClient from "../../config/axios";
    export default
    {
        name : 'products',
        components : {
            Product
        },
        created(){
            //fetches all products
            axiosClient.get('api/products')
                    .then(res => this.products = res.data)
                    .catch(error => console.log(error));
        },
        data() {
            return {
                products : []
            }
        }
    }
</script>

<style>
    p {
        font-family: "Roboto", sans-serif;
        font-size : 3rem;
    }
</style>
