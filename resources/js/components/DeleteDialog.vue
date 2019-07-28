<template>
    <v-layout row justify-center>
        <v-dialog
                v-model="modal"
                max-width="290"
        >
            <v-card>
                <v-card-title class="headline">Delete Confirmation</v-card-title>

                <v-card-text>
                    Are you sure you want to delete this item?
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                            color="success"
                            flat="flat"
                            @click="confirm(!modal)"
                    >
                        Cancel
                    </v-btn>

                    <v-btn color="red" flat @click="confirmDelete" :loading="loading">
                        Yes
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>


    </v-layout>
</template>

<script>
    export default {
        name: "DeleteDialog",
        props: {
            modal: {
                required: true,
                type: Boolean
            },
            item: {
                type: Object,
                default: null
            },
            route: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                loading: false,
            }
        },
        methods: {
            confirmDelete() {
                const vm = this;
                axios.delete(vm.route + vm.item.id)
                    .then(() => {
                        vm.loading = false;
                        vm.confirm(true);
                    })
                    .catch(err => {
                        console.log(err.response.data);
                    })
            },
            confirm(val) {
                this.$emit('confirmed', val)
            }
        }
    }
</script>

<style scoped>

</style>