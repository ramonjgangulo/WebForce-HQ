<template>
    <v-container class="mt-12">
        <v-row>
            <v-col cols="12">
                <v-card >
                    <v-simple-table class="mt-12"fixed-header height="300px">
                        <template v-slot:default>
                            <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Description</th>
                                <th class="text-left">Price</th>
                                <th class="text-left">Quantity</th>
                                <th class="text-left">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="product in allProducts" :key="product.product_id">
                                <td>{{ product.product_name }}</td>
                                <td>{{ product.product_description}}</td>
                                <td>$ USD {{ product.product_price }}</td>
                                <td>{{ product.quantity }}</td>
                                <td>$ USD {{ product.product_price * parseInt(product.quantity) }}</td>
                                <td>
                                    <v-btn
                                        icon
                                        v-on:click="handleDelete(product.product_id)"
                                    >
                                        <v-icon>mdi-delete</v-icon>
                                    </v-btn>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total : </td>
                                <td>$ USD {{calculateTotal}}.00</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name: 'Checkout',
        computed : mapGetters(['allProducts','calculateTotal']),
        methods : {
            ...mapActions(['deleteFromCart']),
            handleDelete(id){
                this.deleteFromCart(id);
            }
        }
    }

</script>
