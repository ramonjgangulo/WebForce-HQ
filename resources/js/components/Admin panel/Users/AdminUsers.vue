<template>
    <div class="d-flex justify-center mt-12">
        <v-card
            width="130vh"
        >
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="headline">Users</v-list-item-title>
                </v-list-item-content>
                    <v-btn icon>
                        <v-icon
                            v-on:click="modal=true"
                        >mdi-account-plus</v-icon>
                    </v-btn>
            </v-list-item>
            <v-simple-table fixed-header height="300px">
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">Id</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users" :key="user.user_id">
                        <td>{{user.user_id}}</td>
                        <td>{{ user.user_name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <v-btn
                                icon
                                v-on:click="selectedId=user.user_id"
                            >
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                            <v-btn
                                icon
                                v-on:click="deleteId=user.user_id"
                            >
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
            <!-- Modal to show and update information for the user -->
            <UserModal
                v-bind:id="selectedId"
                v-bind:modal="modal"
                v-on:update-users="handleUpdate"
            />
            <!-- Dialog to warn before deleting a user -->
            <OptionDialog
                v-bind:dialog="dialog"
                v-bind:title="'Delete User'"
                v-bind:description="'Are yo sure you want to delete this user?'"
                v-bind:id="deleteId"
                v-bind:route="'api/users/'"
                v-on:close-dialog="handleUpdate"
            />
        </v-card>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    import UserModal from "./UserModal";
    import OptionDialog from "../OptionDialog";
    import axiosClient from "../../../config/axios";

    export default {
        name : 'AdminUsers',
        methods:{
            ...mapActions(['quickLogin','enableAdmin']),
            async getUsers(){
                let {data} = await axiosClient.get('api/users');
                this.users = data;
            },
            handleUpdate()
            {
                this.getUsers();
                this.selectedId=0;
                this.deleteId=0;
                this.modal=false;
            }
        },
        components :{
            UserModal,
            OptionDialog
        },
        computed : mapGetters(['checkAdmin']),
        created(){
            //checks if there is a session started
            if(this.checkAdmin)
            {
                this.getUsers();
                return;
            }
            //if not, it attempts to do it with a token stored in local storage
            let token = localStorage.getItem('token');
            if(token) {
                this.enableAdmin()
                this.quickLogin();
                this.getUsers();
                return
            }
            //if token not found, redirects to home page
            this.$router.push('/');
        },
        data(){
            return{
                users:[],
                //variable to control the selected users
                selectedId: 0,
                deleteId:0,
                //variables to control the states of the modals
                modal : false,
                dialog : false

            }
        },
        watch :{
            //watchers to change the modals state based on the selected product
            deleteId (newID)
            {
                this.dialog = newID !== 0;
            },
            selectedId (newId)
            {
                if(newId===0)
                    return;
                this.modal = true;
            }
        }
    }
</script>
