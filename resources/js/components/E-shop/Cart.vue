<template>
    <v-navigation-drawer
        v-model="drawerState"
        fixed
        app
        right
        temporary
        width="400"
    >
        <v-card v-if="allProducts.length!==0"
            class="mt-12 mx-auto pb-6"
            max-width="360"
            tile
        >
            <v-list>
                <v-list-item  max-width="360" v-for="product in allProducts" :key="product.product_id" three-line>
                    <v-row justify="end" align="center">
                        <v-col cols="8">
                            <v-list-item-content>
                                <v-list-item-title>{{product.product_name}}</v-list-item-title>
                                <v-list-item-subtitle>
                                    $ USD {{product.product_price * product.quantity}}
                                </v-list-item-subtitle>
                            </v-list-item-content>
                        </v-col>
                        <v-col cols="2">
                            <v-text-field
                                type="number"
                                v-model="product.quantity"
                                width="50px"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="2">
                            <v-btn
                                icon
                                v-on:click="handleDelete(product.product_id)"
                            >
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item>
                    <v-list-item-subtitle>
                        Total : $ USD {{calculateTotal}}
                    </v-list-item-subtitle>
                </v-list-item>
            </v-list>
            <div class="d-flex justify-center mt-6 mb-12">
                <v-btn
                    color="success"
                    x-large
                    outlined
                    tile
                    to="/checkout"
                >Checkout</v-btn>
            </div>
        </v-card>
        <div v-else class="d-flex justify-center mt-12">
            <span>You don't have products added to your cart</span>
        </div>
        <div class="d-flex justify-center mt-12">
            <v-btn
                class="mb-12"
                color="primary"
                x-large
                outlined
                tile
                v-on:click="handleDrawer"
            >Close Cart</v-btn>
        </div>
    </v-navigation-drawer>
</template>

<script>

    import {mapGetters,mapActions} from 'vuex';
    export default {
        name : 'Cart',
        methods :
        {
          ...mapActions(['showDrawer','deleteFromCart']),
            handleDrawer(){
              this.showDrawer();
            },
            handleDelete(id){
              this.deleteFromCart(id);
            }
        },
        computed : mapGetters(['allProducts','drawerState','calculateTotal']),
    }
</script>
