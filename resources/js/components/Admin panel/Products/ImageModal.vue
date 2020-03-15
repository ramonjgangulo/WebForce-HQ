<template>
    <v-row>
        <v-dialog
            v-model="image"
            persistent
            max-width="400px">
            <v-card
                elevation="3"
            >
                <!--checks if there are any images uploaded-->
                <v-carousel v-if="images.length!==0" hide-delimiters>
                    <v-carousel-item
                        v-for="(product_image,i) in images"
                        :key="i"
                        :src="product_image"
                    ></v-carousel-item>
                </v-carousel>
                <!-- shows message if not -->
                <v-card-title v-else>
                    There are no images uploaded
                </v-card-title>
                <v-card-text>
                    <v-file-input
                        multiple
                        chips
                        label="Add Image"
                        dense
                        v-model="product_image"
                        v-bind:error-messages="validationErrors.product_image?validationErrors.product_image:''"
                    ></v-file-input>
                        <!-- binds validation errors caught from laravel form request -->
                </v-card-text>
                <v-card-actions>
                    <v-btn color="green darken-1" text v-on:click="$emit('close-image-modal')">Close</v-btn>
                    <v-btn color="green darken-1" text v-on:click="updloadImage">Upload</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import axiosClient from "../../../config/axios";

    export default {
        name : 'ImageModal',
        props : ['product_id','image'],
        data(){
             return {
                 product_image : null,
                 images : [],
                 validationErrors : {}
             }
        },
        methods :{
            async updloadImage()
            {
                try {
                    let formData = new FormData();

                    formData.append('product_image',this.product_image[0]);
                    formData.append('product_id',this.product_id);

                    let response = await axiosClient.post('api/media',formData);

                    this.getImages();
                    this.validationErrors = {};
                    this.product_image=null;
                }catch (e) {
                    console.log(e)
                    const {errors} = e.response.data;
                    this.validationErrors = errors;                }
            },
            async getImages()
            {
                try{
                    let response = await axiosClient.get('api/media/' + this.product_id);
                    console.log(response.data.product_images);
                    this.images = response.data.product_images;
                }catch (e) {
                }
            }
        },
        watch : {
            //fetches images each time a new product is selected
            product_id(newId){
                if(newId===0)
                    return;
                this.getImages();
            }
        }

    }
</script>
