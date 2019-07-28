<template>
    <v-card>
        <v-card-title class="justify-center">
            <h2>{{ reset_password }}</h2>
        </v-card-title>
        <v-card-text>
            <form @submit.prevent="sendPasswordResetLink">
                <v-text-field
                        v-model="form.token"
                        type="hidden"
                        required
                >
                </v-text-field>
                <v-text-field
                        :error-messages="form.errors.get('email')"
                        v-model="form.email"
                        label="E-mail"
                        required
                >
                </v-text-field>
                <v-text-field
                        :append-icon="showPassword ? 'visibility' : 'visibility_off'"
                        :rules="[rules.required, rules.min]"
                        :type="showPassword ? 'text' : 'password'"
                        hint="At least 8 characters"
                        @click:append="showPassword = !showPassword"
                        :error-messages="form.errors.get('password')"
                        v-model="form.password"
                        label="Password"
                >
                </v-text-field>
                <v-text-field
                        v-model="form.password_confirmation"
                        label="Confirm Password"
                        type="password"
                        :append-icon="showConfirmPassword ? 'visibility' : 'visibility_off'"
                        :rules="[rules.required, rules.passwordMatch]"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        @click:append="showConfirmPassword = !showConfirmPassword"
                >
                </v-text-field>
                <v-btn type="submit">{{ update_password }}</v-btn>
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
            update_password: {
                required: true,
                type: String
            },
            token: {
                default: '',
                type: String
            }
        },
        data() {
            return {
                snackbar: false,
                form: new Form({
                    email: '',
                    token: '',
                    password: '',
                    password_confirmation: ''
                }),
                status: '',
                rules: {
                    required: value => !!value || 'required',
                    min: v => v.length >= 8 || 'Min 8 characters',
                    passwordMatch: () => {
                        if (this.form.password !== this.form.password_confirmation) {
                            return 'Password confirmation you entered don\'t match'
                        }
                        return true;
                    }
                },
                showPassword: false,
                showConfirmPassword: false
            }
        },
        methods: {
            sendPasswordResetLink() {
                let vim = this;
                this.form.post(this.route)
                    .then((res) => {
                        if (res.hasOwnProperty('location')) {
                            window.location.href = res.location;
                            return;
                        }
                        vim.status = res.status;
                        vim.snackbar = true;
                    })
                    .catch((error) => {
                        if (error.response.status === 419) {
                            vim.status = 'You are already logged in!';
                            vim.snackbar = true;
                        }
                        this.form.token = this.token;
                    })
            }
        },
        mounted() {
            this.form.token = this.token;
        },
        watch: {
            snackbar(val) {
                if (val === false) this.status = '';
            }
        }
    }
</script>

<style scoped>

</style>