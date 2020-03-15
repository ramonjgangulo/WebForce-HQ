<template>
    <v-row>
    <v-dialog v-model="modal" persistent max-width="600px">
        <v-card>
            <form v-on:submit="handleSubmit">
                <v-card-title>
                    <span class="headline">{{id!=0 ?'Edit':'Create'}} Product </span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    dense
                                    v-model="product.product_name"
                                    label="Name*"
                                    v-bind:error-messages="validationErrors.product_name?validationErrors.product_name:''"
                                ></v-text-field>
                                <!--binds validation errors caught from laravel form request to each input-->
                                <v-text-field
                                    dense
                                    v-model="product.product_description"
                                    label="Description*"
                                    v-bind:error-messages="validationErrors.product_description?validationErrors.product_description:''"
                                ></v-text-field>
                                <v-text-field
                                    dense
                                    v-model="product.product_price"
                                    label="Price*"
                                    type="number"
                                    v-bind:error-messages="validationErrors.product_price?validationErrors.product_price:''"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="cleanModal">Close</v-btn>
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
        name : 'ProductModal',
        props : ['modal','id'],
        methods :{

            async handleSubmit(){
                try {
                    const { product } = this;

                    let response;
                    //changes request based on if there is a selected user or not (0 means there is not a selected user)
                    if(this.id!==0)
                         response = await axiosClient.put('api/products/'+this.id, product);
                     else
                        response = await axiosClient.post('api/products', product);


                    this.validationErrors = {};
                    this.cleanModal();
                }catch (e) {
                    const {errors} = e.response.data;
                    this.validationErrors= errors;
                }
            },
            // method to reset values and close modal
            cleanModal(){
                this.$emit('update-products');
                this.product.product_name='';
                this.product.product_description='';
                this.product.product_price=0;
            },
        },
        data() {
            return {
                // object to store product info
                product : {
                    product_name :'',
                    product_description :'',
                    product_price : 0,
                },
                // object to store validation errors fetched from laravel form request
                validationErrors : {}
            }
        },
        watch:{
            //if selected user, it fetches the users info and sets the product values to the values it got from the endpoint
            id : async function (newId, oldId){
                if(newId === 0)
                    return
                const {data} = await axiosClient.get('api/products/'+newId);

                this.product.product_name = data.product_name;
                this.product.product_description = data.product_description;
                this.product.product_price = parseFloat(data.product_price);
            }
        }
    }
</script>
