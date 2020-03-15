<template>
    <v-card
        v-bind:hover="true"
        max-width="400"
        class="mx-auto"
        v-bind:to="'/details/'+product.product_id"
        :ripple="false"
    >
        <v-img
            class="white--text align-end"
            height="200px"
            v-bind:src="product.product_image"
        >
        </v-img>

        <v-card-subtitle class="pb-0">{{product.product_name}}</v-card-subtitle>

        <v-card-text class="text--primary">
            <div>{{product.product_price}}</div>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                tile
                depressed
                color="primary"
                v-on:click="handleAdition"
            >
                <v-icon left>mdi-plus-thick</v-icon> to cart
            </v-btn>
            <v-btn
                tile
                color="primary"
                outlined
                link
                v-bind:to="'/details/'+product.product_id"
            >
                Details
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

    import {mapActions} from 'vuex';
    export default {
        name: 'Product',
        props : ['product'],
        methods : {
            ...mapActions(['addProduct']),
            handleAdition(e){
                e.preventDefault();
                //adds the selected product to the cart with a quantity of one
                this.addProduct({
                    ...this.product,
                    'quantity' : 1
                });
            }
        }
    }
</script>
