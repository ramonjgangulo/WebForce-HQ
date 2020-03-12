<template>
    <v-container
        class="mt-12"
    >
        <v-row class="mt-12">
            <p>All products</p>
        </v-row>
        <v-divider></v-divider>
        <v-row>
            <v-col
                v-bind:key="product.id"
                v-for="product in products"
                cols="4"
            >
                <Product v-bind:product="product"></Product>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import Product from "./Product";
    import axiosClient from "../axios";
    export default
    {
        name : 'products',
        components : {
            Product
        },
        created(){
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
