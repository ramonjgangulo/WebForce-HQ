<template>
    <div>
        <v-app-bar
            color="rgb(200,200,200)"
            fixed
            max-height="100vh"
        >
            <ul>
                <li>
                    <router-link to="/">
                    Home
                    </router-link>
                </li>
                <li>
                    <router-link to="/details/2">
                    Products
                    </router-link>
                </li>
                <li>
                    <router-link to="/">
                    Contact
                    </router-link>
                </li>
            </ul>
            <v-img
                src="./vans-logo.png"
                contain
                max-height="10vh"
            ></v-img>
            <v-spacer></v-spacer>
            <v-btn
                v-on:click="handleDrawer"
                text
                large>
                <v-icon left>mdi-cart</v-icon>
                CART
                {{countProducts}}
            </v-btn>
        </v-app-bar>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';

    export default {
        name: 'navbar',
        computed : mapGetters(['countProducts']),
        methods: {
            ...mapActions(['showDrawer']),
            handleDrawer(){
                this.showDrawer();
            }
        }
    }
</script>
<style>
    li a{
        font-family: "Roboto", sans-serif;
        display: block;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        color: #000000 !important;
    }
    li{
        float: left;
    }
    li a:hover{
        color: #ffffff!important;
        background-color: #000
    }
    ul {
        list-style-type: none;
        margin: 0;
        padding-left: 5vh;
    }
    div {
        font-family: "Roboto", sans-serif;
    }
</style>
