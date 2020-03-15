<template>
    <div class="d-flex justify-center mt-12">
        <v-card
            width="130vh"
        >
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="headline">Products</v-list-item-title>
                </v-list-item-content>
                <v-btn icon>
                    <v-icon
                        @click="modal = true"
                    >mdi-cart-plus</v-icon>
                </v-btn>
            </v-list-item>
            <v-simple-table fixed-header height="300px">
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">Id</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Description</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products" :key="product.product_id">
                        <td>{{product.product_id}}</td>
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.product_description }}</td>
                        <td>
                            <v-btn
                                icon
                                v-on:click=" selectedId  = product.product_id "
                            >
                                <v-icon>mdi-pencil</v-icon>
                            </v-btn>
                            <v-btn
                                icon
                                v-on:click="deleteId = product.product_id"
                            >
                                <v-icon>mdi-delete</v-icon>
                            </v-btn>
                            <v-btn
                                icon
                                v-on:click="productImagesId = product.product_id"
                            >
                                <v-icon>mdi-eye</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
            <!-- Modal to show and update information for the product -->
            <ProductModal
                v-bind:modal="modal"
                v-bind:id="selectedId"
                v-on:update-products="handleUpdate"
            />
            <!-- Modal to show and add images for the product-->
            <ImageModal
                v-bind:image="image"
                v-bind:product_id="productImagesId"
                v-on:close-image-modal="productImagesId = 0"
            />
            <!-- Dialog to warn before deleting a product -->
            <OptionDialog
                v-bind:dialog="dialog"
                v-bind:title="'Delete Product'"
                v-bind:description="'Are yo sure you want to delete this product?'"
                v-bind:id="deleteId"
                v-bind:route="'api/products/'"
                v-on:close-dialog="handleUpdate"
            />
        </v-card>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    import axiosClient from "../../../config/axios";
    import ProductModal from "./ProductModal";
    import ImageModal from "./ImageModal";
    import OptionDialog from "../OptionDialog";

    export default {
        name : 'AdminProducts',
        components: {ImageModal, ProductModal,OptionDialog},
        component : {
            ProductModal,
            ImageModal
        },
        methods : {
            ...mapActions(['quickLogin','enableAdmin']),
            async getProducts(){
                let {data} = await axiosClient.get('api/products');
                console.log(data);
                this.products = data;
            },
            handleUpdate()
            {
                this.getProducts();
                this.selectedId=0;
                this.deleteId=0;
                this.modal=false;
            },
        },
        computed : mapGetters(['checkAdmin']),
        created(){
            //checks if there is a session started
            if(this.checkAdmin)
            {
                this.getProducts();
                return;
            }
            //if not, it attempts to do it with a token stored in local storage
            let token = localStorage.getItem('token');
            if(token) {
                this.enableAdmin()
                this.quickLogin();
                this.getProducts();
                return
            }
            //if token not found, redirects to home page
            this.$router.push('/');
        },
        data(){
            return {
                products : []  ,
                //variable to control the selected products
                selectedId : 0,
                deleteId : 0,
                productImagesId : 0,
                //variables to control the states of the modals
                modal : false,
                image : false,
                dialog : false,
            };
        },
        watch : {
            //watchers to change the modals state based on the selected product
            productImagesId (newId)
            {
                this.image = newId !== 0;
            },
            deleteId (newId)
            {
                this.dialog = newId !== 0;
            },
            selectedId(newId){
                if(newId===0)
                    return;
                this.modal = true;
            }
        }
    }
</script>
