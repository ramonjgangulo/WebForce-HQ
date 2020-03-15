<template>
    <v-app>
        <navbar v-if="!checkAdmin"/>
        <div style="min-height: 100vh">
            <v-content>
                <!-- content based on route -->
            <router-view/>
            </v-content>
        </div>
        <!-- checks if a user has  a started session to see wich component it will need -->
        <cart v-if="!checkAdmin"/>
        <sidebar v-else/>
        <Footer v-if="!checkAdmin"/>
        <!-- snackbar used to display if a product has been added to the cart -->
        <v-snackbar
            v-model="snackbarState"
            color="success"
            top
            right
            :timeout="5000"
            v-on:input="hide"
            class="mt-12"
        >
            {{getNewProduct.product_name}}
            <v-btn
                icon
                v-on:click="hide"
            >
                <v-icon left>mdi-close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-app>
</template>

<script>
    import navbar from './E-shop/NavBar';
    import Cart from "./E-shop/Cart";
    import Sidebar from "./Admin panel/Sidebar";
    import Footer from "./E-shop/Footer";
    //Required components
    import {mapGetters,mapActions} from 'vuex';

    export default {
        name :'app',
        components :{
            Cart,
            Sidebar,
            navbar,
            Footer
        },
        methods : {
          ...mapActions(['hideSnackbar']),
          hide(){
              this.hideSnackbar();
          }
        },
        computed : mapGetters(['getNewProduct','snackbarState','checkAdmin'])
    }
</script>
