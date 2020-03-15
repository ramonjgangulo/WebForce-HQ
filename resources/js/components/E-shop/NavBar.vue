<template>
    <v-app-bar
        text
        color="indigo lighten-4"
        fixed
    >
        <v-app-bar-nav-icon
            class="hidden-md-and-up"
        ></v-app-bar-nav-icon>
        <v-container
            mx-auto
        >
            <v-layout>
                <v-img
                    src="./vans-logo.png"
                    height="70"
                    width="70"
                    max-width="70"
                    class="mr-12"
                ></v-img>
                <v-btn
                    v-for="(link, i) in links"
                    :key="i"
                    :to="link.to"
                    text
                    large
                    tile
                    height="68"
                    class="hidden-sm-and-down"
                >
                    {{ link.text }}
                </v-btn>
                <v-spacer />
                <v-btn
                    v-on:click="handleDrawer"
                    text
                    large
                    height="70"
                >
                    <v-icon left>mdi-cart</v-icon>
                    CART
                    {{countProducts}}
                </v-btn>
            </v-layout>
        </v-container>
    </v-app-bar>
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
        },
        data(){
            return {
                links : [
                    { to : '/home' , text : 'Home'},
                    { to : '/' , text : 'Products'},
                    { to : '/contact' , text : 'Contact'}
                ]
            }
        }
    }
</script>
