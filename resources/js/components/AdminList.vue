<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-container>
        <v-layout row wrap class="pa-3" justify-space-between fill-height>
            <v-flex xs12 sm6 md4 lg3 v-for="admin in admins" :key="admin.id" class="ma-3">
                <v-card>
                    <v-card-title>
                        <v-layout justify-center row wrap>
                            <v-flex xs12 class="display-1 text-center py-3">{{ admin.name }}</v-flex>
                            <v-flex xs12 class="caption text-uppercase grey--text text-center">{{ admin.role.name }}</v-flex>
                        </v-layout>
                    </v-card-title>
                    <v-spacer></v-spacer>
                    <v-card-actions>
                        <v-layout justify-center>
                            <v-btn :href="route+admin.id+'/edit'" style="text-decoration: none" flat>Edit</v-btn>
                            <v-btn flat @click="deleteItem(admin)">Delete</v-btn>
                        </v-layout>
                    </v-card-actions>
                </v-card>
            </v-flex>

        </v-layout>

        <delete-dialog :modal="modal" :route="route" :item="item"  @confirmed="confirmation"></delete-dialog>
    </v-container>
</template>

<script>
    export default {
        props: {
          adminlist: {
              type: Array
          }
        },
        data () {
            return {
                admins: this.adminlist,
                modal: false,
                route: '/admins/',
                item: null
            }
        },
        methods: {
            deleteItem(admin) {
                this.modal = !this.modal;
                this.item = admin
            },
            confirmation(val) {
                this.modal = !this.modal;
                if (val) {
                    let adminIndex = this.admins.indexOf(this.item);
                    this.admins.splice(adminIndex, 1);
                }
            }
        }
    }
</script>

<style scoped>

</style>