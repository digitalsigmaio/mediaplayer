<template>
    <v-card>
        <v-card-title class="justify-center">
            <h2>{{ reset_password }}</h2>
        </v-card-title>
        <v-card-text>
            <form @submit.prevent="sendPasswordResetLink">
                <v-text-field
                        :error-messages="form.errors.get('email')"
                        v-model="form.email"
                        label="E-mail"
                        required
                >
                </v-text-field>
                <v-btn type="submit">{{ send_password }}</v-btn>
            </form>

            <v-snackbar
                    v-model="snackbar"
                    :top="true"
                    :vertical="true"
            >
                {{ status }}
                <v-btn
                        color="pink"
                        flat
                        @click="snackbar = false"
                >
                    Close
                </v-btn>
            </v-snackbar>
        </v-card-text>
    </v-card>
</template>

<script>
    import Form from "../../core/Form";

    export default {
        props: {
            reset_password: {
                required: true,
                type: String
            },
            route: {
                required: true,
                type: String
            },
            send_password: {
                required: true,
                type: String
            }
        },
        data() {
            return {
                snackbar: false,
                form: new Form({
                  email: ''
                }),
                status: ''
            }
        },
        methods: {
            sendPasswordResetLink() {
                let vim = this;
                this.form.post(this.route)
                    .then((res) => {
                        vim.status = res.status;
                        vim.snackbar = true;
                    })
                    .catch((error) => {
                        if (error.response.status === 419) {
                            vim.status = 'You are already logged in!';
                            vim.snackbar = true;
                        }
                    })
            }
        },
    }
</script>

<style scoped>

</style>