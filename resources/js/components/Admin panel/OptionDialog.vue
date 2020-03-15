<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="290">
            <v-card>
                <v-card-title class="headline">{{title}}</v-card-title>
                <v-card-text>{{description}}</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="handleDelete(0)">Disagree</v-btn>
                    <v-btn color="primary" text @click="handleDelete(id)">Agree</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
    import axiosClient from "../../config/axios";
    export default {
        name : 'OptionDialog',
        props : ['title','description','dialog','route','id'],
        methods :{
            async handleDelete(id){
                try{
                    //if 0, it just closes the modal
                    if(id==0)
                    {
                        this.$emit('close-dialog');
                        return;
                    }
                    //else , deletes user/product and then closes the modal
                    let response = await axiosClient.delete(this.route+id);
                    this.$emit('close-dialog');
                }catch (e) {
                    console.log(e);
                }
            },
        }
    }
</script>
