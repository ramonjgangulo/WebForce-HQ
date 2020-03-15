<template>
    <v-row justify="center">
        <v-dialog v-model="modal" persistent max-width="600px">
            <v-card>
                <form v-on:submit="handleSubmit">
                <v-card-title>
                    <!--I used the same component to edit and create -->
                    <span class="headline">{{id!=0 ?'Edit':'Create'}} User Profile</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    dense
                                    v-model="user.user_name"
                                    label="Name*"
                                    v-bind:error-messages="validationErrors.user_name?validationErrors.user_name:''"
                                    ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    dense
                                    v-model="user.email"
                                    label="Email*"
                                    type="email"
                                    v-bind:error-messages="validationErrors.email?validationErrors.email:''"
                                    ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    dense
                                    v-model="user.password"
                                    label="Password*"
                                    type="password"
                                    v-bind:error-messages="validationErrors.password?validationErrors.password:''"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    dense
                                    v-model="user.confirmedPassword"
                                    label="Confirm password*"
                                    type="password"
                                    v-bind:error-messages="validationErrors.confirmedPassword?validationErrors.confirmedPassword:''"
                                ></v-text-field>
                            </v-col>
                            <!-- the active user's password is required to create or alter user profiles -->
                            <v-col cols="12">
                                <v-text-field
                                    dense
                                    v-model="user.activeUserPassword"
                                    label="Active users password*"
                                    type="password"
                                    v-bind:error-messages="validationErrors.activeUserPassword?validationErrors.activeUserPassword:''"
                                ></v-text-field>
                            </v-col>

                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text v-on:click="cleanModal">Close</v-btn>
                    <v-btn type="submit" color="blue darken-1" text >Save</v-btn>
                </v-card-actions>
                </form>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import axiosClient from "../../../config/axios";

    export default {
        name : 'UserModal',
        props : ['modal','id'],
        methods :{

            async handleSubmit(){
                try {
                    const { user_name, email, password, confirmedPassword, activeUserPassword,validationErrors} = this.user;
                    //validates if passwords match
                    if( password!==confirmedPassword)
                    {
                        this.validationErrors = {
                            confirmedPassword : 'Passwords don\'t match'
                        }
                        return;
                    }
                    const user ={
                        user_name,
                        email,
                        activeUserPassword
                    };
                    //Updating the password is optional, so if textfield is empty, it does'nt include it in the body
                    if(password!=='')
                        user.password = password;

                    console.log(user);
                    //if theres a selected user, updates, else, creates
                    let response = this.id!=0?
                        await axiosClient.put('api/users/' + this.id, user) :
                        await axiosClient.post('api/users', user) ;
                    this.validationErrors = {};

                    this.cleanModal();
                }catch (e) {
                    const {errors} = e.response.data;
                    this.validationErrors= errors;
                }
            },
            //methods  to reset variables and close modal
            cleanModal(){
                this.$emit('update-users');
                this.user.email='';
                this.user.user_name='';
                this.user.password='';
                this.user.activeUserPassword='';
                this.user.confirmedPassword='';
            },
        },
        data() {
            return {
                user : {
                    user_name :'',
                    email :'',
                    password : '',
                    confirmedPassword : '',
                    activeUserPassword : '',
                },
                validationErrors : {}
            }
        },
        watch:{
            id : async function (newId, oldId){
                if(newId==0)
                    return;
                const {data} = await axiosClient.get('api/users/'+newId);

                this.user.user_name = data.user_name;
                this.user.email = data.email;
            }
        }
    }
</script>
