<template>
   <v-card>
       <v-card-title class="justify-center">
            <h2>Login</h2>
       </v-card-title>
       <v-card-text>
           <form @submit.prevent="submit()">
               <v-text-field
                       v-model="form.email"
                       :error-messages="form.errors.get('email')"
                       label="E-mail"
                       required
               ></v-text-field>
               <v-text-field
                       v-model="form.password"
                       type="password"
                       :error-messages="form.errors.get('password')"
                       label="Password"
                       required
               >

               </v-text-field>
               <v-checkbox
                       v-model="form.remember"
                       :error-messages="form.errors.get('remember')"
                       value="1"
                       label="Remember Me"
                       type="checkbox"
               ></v-checkbox>

               <v-btn type="submit">submit</v-btn>
               <v-btn @click="form.reset()">clear</v-btn>
               <a class="btn btn-link" v-if="has_request" :href="password_request">
                   {{ forgot_password}}
               </a>
           </form>
       </v-card-text>
   </v-card>
</template>
<script>
    import Form from '../core/Form';

    export default {
        props: {
            route: {
                required: true,
                type: String
            },
            has_request: {
                default: true,
                type: Number
            },
            password_request: {
                type: String
            },
            forgot_password: {
                type: String
            }
        },
        data: () => ({
            form: new Form({
                email: '',
                password: '',
                remember: null
            }),
        }),

        mounted() {

        },
        computed: {
            login: function () {
                return this.route
            }
        },
        methods: {
            submit() {
                this.form.post(this.login)
                    .then((res) => {
                        window.location.href = '/dashboard'
                    })
                    .catch((error) => {

                    });
            }
        }
    }
</script>