<template>
    <v-footer
        color="blue-grey darken-2"
        padless
    >
        <v-row
            justify="end"
            class="mt-6"
        >
            <v-col cols="2">
                <v-text-field
                    outlined
                    dense
                    label="Email"
                    background-color="white"
                >
                </v-text-field>
            </v-col>
            <v-col cols="2">
                <v-text-field
                    outlined
                    dense
                    label="Password"
                    background-color="white"
                >
                </v-text-field>
            </v-col>
            <v-col cols="1">
                <v-btn
                    color="white"
                    text
                    rounded
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
</template>

<script>
    export default {
        name : 'Footer'
    }
</script>
