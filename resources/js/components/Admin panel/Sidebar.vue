<template>
    <v-navigation-drawer
        fixed
        app
        permanent
        height="100vh"
        color="teal"
        width="300"
        dark
    >
        <v-list-item>
            <v-list-item-content>
                <v-list-item-title class="title">
                    Admin Panel
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list
            nav
        >
            <v-list-item
                v-for="item in items"
                :key="item.title"
                link
                router
                v-bind:to="item.path"

            >
                <v-list-item-icon>
                    <v-icon>{{item.icon}}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>{{item.title}}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
        <div class="d-flex justify-center mt-12">
            <v-btn
                class="mb-12"
                color="primary"
                x-large
                tile
                v-on:click="handleLogout"
            >
                <v-icon left>mdi-logout</v-icon>
                Logout
            </v-btn>
        </div>
    </v-navigation-drawer>
</template>

<script>
    import {mapActions} from 'vuex'
    export default {
        name : 'Sidebar',
        methods : {
            ...mapActions(['logout']),
            handleLogout(){
                this.logout();
                this.$router.push('/');
            }
        },
        data (){
            return(
                {
                    items:[
                        {title:'Users',path: '/admin/users',icon:'mdi-account'},
                        {title:'Products',path: '/admin/products',icon:'mdi-cart'},
                    ]
                }
            )
        }
    }
</script>

