<template>
    <v-container
        class="mt-12"
    >
        <v-row >
            <v-col
                class="mt-12"
                cols="4"
            >
                <v-card
                    elevation="3"
                >
                    <v-img
                        v-bind:src="product.img"
                    >
                    </v-img>
                </v-card>
            </v-col>
            <v-col
                offset="2"
                cols="6"
            >

                <v-row class="mt-12">
                    <p><span>{{product.product_name}}</span></p>
                </v-row >
                <v-row class="mb-12">
                    <p>{{product.product_description}}</p>
                </v-row>
                <v-row class="mb-12">
                    <p>$ USD {{product.product_price}}</p>
                </v-row>
                <v-row class="mb-12">
                    <v-col cols="4">
                        <v-text-field
                            label="Quantity"
                            type="number"
                            v-model="quantity"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="4">
                        <v-btn
                            x-large
                            tile
                            color="primary"
                            v-on:click="addToCart"
                        >Add to cart</v-btn>
                    </v-col>
                    <v-col cols="4">
                        <v-btn
                            x-large
                            tile
                            outlined
                            link
                            to="/checkout"
                            color="primary"
                        >Checkout</v-btn>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import axiosClient from '../axios';
    import {mapActions} from 'vuex';

    export default {
        data(){
            return {
                product:{},
                quantity : 0
            }
        },
        created(){
            axiosClient.get('api/products/'+this.$route.params.id)
                .then(res => this.product = res.data)
                .catch(error => console.log(error));
        },
        methods : {
            ...mapActions(['addProduct']),
            addToCart(){
                let quantity = parseInt(this.quantity);
                this.addProduct({
                    ...this.product,
                    quantity
                });
            }
        },
        mounted() {
        }
    }
</script>

<style scoped>

    p {
        font-family: "Roboto", sans-serif;
        font-size: 1.2rem;
    }
    p span{
        font-family: "Roboto", sans-serif;
        font-size: 2rem;
        font-weight: bold;
    }

</style>
