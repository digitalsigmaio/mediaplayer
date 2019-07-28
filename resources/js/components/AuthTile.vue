<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
        <v-menu open-on-hover bottom offset-y>
            <template v-slot:activator="{ on }">
                <v-btn
                        dark
                        flat
                        v-on="on"
                >
                    {{ admin.name }}
                    <v-icon dark right>arrow_drop_down</v-icon>
                </v-btn>
            </template>

            <v-list>
                <v-list-tile
                        @click="$emit('account')"
                >
                    <v-list-tile-title class="body-1">Account</v-list-tile-title>
                    <v-icon dark right small>settings</v-icon>
                </v-list-tile>
                <v-list-tile>
                    <v-switch
                            v-model="dark"
                            label="Theme"
                    ></v-switch>
                </v-list-tile>
                <v-list-tile
                        @click="$emit('logout')"
                >
                    <v-list-tile-title class="body-1">Logout</v-list-tile-title>
                    <v-icon dark right small>exit_to_app</v-icon>
                </v-list-tile>
            </v-list>
        </v-menu>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    export default {
        name: "AuthTile",
        props: {
            admin: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                //
            }
        },
        computed: {
            ...mapGetters(['currentTheme']),
            dark: {
                get(){
                    return this.currentTheme;
                },
                set(value){
                    this.changeTheme(value);
                }
            }
        },
        methods: {
            ...mapActions(['changeTheme']),
        }
    }
</script>

<style scoped>

</style>