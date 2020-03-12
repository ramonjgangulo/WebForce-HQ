<template>
    <v-card
        v-bind:hover="true"
        height="80vh"
    >
        <v-img
            class="white--text align-end"
            height="60vh"
            v-bind:src="product.img"
        >
        </v-img>

        <v-card-subtitle class="pb-0">{{product.product_name}}</v-card-subtitle>

        <v-card-text class="text--primary">
            <div>{{product.product_price}}</div>
        </v-card-text>

        <v-card-actions class="justify-center " >
            <v-btn
                large
                tile
                color="primary"
                width="9vw"
                v-on:click="handleAdition"
            >
                Add to cart
            </v-btn>

            <v-btn
                large
                tile
                color="primary"
                outlined
                link
                width="9vw"
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
            handleAdition(){
                this.addProduct({
                    ...this.product,
                    'quantity' : 1
                });
            }
        }
    }
</script>
