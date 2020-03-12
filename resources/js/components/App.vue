<template>
    <v-app>
        <navbar/>
        <router-view/>
        <cart/>
        <Footer/>
        <v-snackbar
            v-model="snackbarState"
            color="success"
            top
            right
            :timeout="5000"
            v-on:input="hide"
            class="mt-12"
        >
            {{getNewProduct.product_name?getNewProduct.product_name:''}}
            <v-btn
                icon
                @click="hide"
            >
                <v-icon left>mdi-close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-app>
</template>

<script>
    import navbar from './NavBar';
    import Cart from "./Cart";
    import Footer from "./Footer";
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name :'app',
        components :{
            Cart,
            navbar,
            Footer
        },
        mounted() {
            console.log('mounted');
        },
        methods : {
          ...mapActions(['hideSnackbar']),
          hide(){
              this.hideSnackbar();
          }
        },
        computed : mapGetters(['getNewProduct','snackbarState'])

    }
</script>
