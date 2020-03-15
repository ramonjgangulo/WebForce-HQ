<template>
    <v-container
        class="mt-12"
    >
        <v-row justify="center" >
            <v-col
                class="mt-12 col-sm-10 col-md-4 ml-md-0 ml-1"
            >
                <v-card
                    elevation="3"
                >
                    <v-carousel hide-delimiters>
                        <v-carousel-item
                            v-for="(product_image,i) in product_images"
                            :key="i"
                            :src="product_image"
                        ></v-carousel-item>
                    </v-carousel>
                </v-card>
            </v-col>
            <v-col
                class="mt-sm-0 mt-md-12 col-sm-10 col-md-6 offset-1"
            >
                <v-row class="mt-md-12 col-sm-0">
                    <p><span>{{product.product_name}}</span></p>
                </v-row >
                <v-row class="mb-md-12 col-sm-0">
                    <p>{{product.product_description}}</p>
                </v-row>
                <v-row class="mb-md-12 col-sm-0">
                    <p>$ USD {{product.product_price}}</p>
                </v-row>
                <v-row class="mb-md-12 col-sm-0">
                    <v-col cols="4">
                        <v-text-field
                            label="Quantity"
                            type="number"
                            v-model="quantity"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col class="col-10 col-md-4">
                        <v-btn
                            block
                            large
                            tile
                            color="primary"
                            v-on:click="addToCart"
                        >Add to cart</v-btn>
                    </v-col>
                    <v-col class="col-10 col-md-4">
                        <v-btn
                            large
                            block
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
    import axiosClient from '../../config/axios';
    import {mapActions} from 'vuex';

    export default {
        data(){
            return {
                //variable to store the product's info
                product:{},
                //variable to store all the product's images url
                product_images : [],
                //variable to control te quantity input
                quantity : 0
            }
        },
        async created(){
            try {
                //fetches product's info
                let {data} = await axiosClient.get('api/products/' + this.$route.params.id)
                this.product = data;

                //fetches product's images using the media api
                let response = await axiosClient.get('api/media/' + this.$route.params.id)
                this.product_images = response.data.product_images;

            }catch(e){
                console.log(e)
            }


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
