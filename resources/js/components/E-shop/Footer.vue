<template>
    <form v-on:submit="handleLogin">
    <v-footer
        color="blue-grey"
        padless
    >
        <v-row
            justify="end"
            class="mt-6"
        >
            <v-col class=" col-md-2 col-xs-12">
                <v-text-field
                    outlined
                    dense
                    v-model="email"
                    label="Email"
                    background-color="white"
                >
                </v-text-field>
            </v-col>
            <v-col class=" col-md-2 col-xs-12">
                <v-text-field
                    outlined
                    dense
                    v-model="password"
                    type="password"
                    label="Password"
                    background-color="white"
                >
                </v-text-field>
            </v-col>
            <v-col class=" col-md-1 col-xs-12">
                <v-btn
                    color="white"
                    text
                    rounded
                    type="submit"
                >
                    Login
                </v-btn>
            </v-col>

            <v-col
                class="blue-grey lighten-1 py-4 text-center white--text"
                cols="12"
            >
                {{ new Date().getFullYear() }} — <strong>Vans</strong>
            </v-col>
        </v-row>
    </v-footer>
    </form>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    export default {
        name : 'Footer',
        data(){
            return {
                email :'',
                password : ''
            }
        },
        methods : {
            ...mapActions(['login']),
            handleLogin(e){
                e.preventDefault();
                //attempt to login
                this.login({
                    email : this.email,
                    password : this.password
                })
            }
        },
        computed : mapGetters(['getToken','getUser']),
        created() {
            this.$store.subscribe((mutation,state)=>{
                //if mutation occurs, it goes to the admin. route
                if(mutation.type==='setUser')
                {
                    this.$router.push('/admin/users');
                }
            });
        }
    }
</script>
