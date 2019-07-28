<template>
    <v-card>
        <v-card-text>
            <v-form v-model="valid" ref="form">

                <v-text-field
                        v-model="name"
                        :rules="nameRules"
                        :counter="30"
                        label="Name"
                        required
                ></v-text-field>

                <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="E-mail"
                        required
                ></v-text-field>

                <v-text-field
                        v-model="password"
                        :append-icon="showPassword ? 'visibility' : 'visibility_off'"
                        :type="showPassword ? 'text' : 'password'"
                        :rules="passwordRules"
                        :counter="30"
                        label="Password"
                        required
                        @click:append="showPassword = !showPassword"
                ></v-text-field>

                <v-select
                        v-model="roleId"
                        :items="roles"
                        item-text="name"
                        item-value="id"
                        :rules="roleRules"
                        label="Role"
                        required
                ></v-select>

                <v-btn  @click="create" class="ml-0 mt-2">
                    Create
                </v-btn>

            </v-form>
        </v-card-text>

        <v-snackbar
                v-model="snackbar"
                bottom
                :multi-line="!!Object.keys(errors).length"
                :color="success ? 'success' : 'error'"
        >

            {{ text }}
            <d-flex xs12 v-if="Object.keys(errors).length">
                <p v-for="(error, key) in errors" :key="key">
                    {{ error[0] }}
                </p>
            </d-flex>
            <v-btn
                flat
                @click="snackbar = false"
            >
                <v-icon>
                    close
                </v-icon>
            </v-btn>
        </v-snackbar>
    </v-card>
</template>

<script>
    export default {
        props: {
          roles: {
              type: Array,
              required: true
          }
        },
        data: () => {
            return {
                valid: false,
                name: '',
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 30) || 'Name must be less than 30 characters'
                ],
                email: '',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                password: '',
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => (v && v.length >= 6) || 'Password can\'t be less than 6 characters'
                ],
                roleId: null,
                roleRules: [
                    v => !!v || 'Role is required'
                ],
                errors: {},
                snackbar: false,
                text: '',
                success: true,
                showPassword: false,
            }
        },
        methods: {
            create() {
                const vm = this;
                if (vm.$refs.form.validate()) {
                    axios.post('/admins', {
                        name: vm.name,
                        email: vm.email,
                        password: vm.password,
                        roleId: vm.roleId
                    })
                        .then(() => {
                            vm.errors = {};
                            vm.text = 'Admin has been created!';
                            vm.success = true;
                            vm.snackbar = true;
                            vm.$refs.form.reset();
                        })
                        .catch(e => {
                            if (e.response.status === 422) {
                                vm.text = e.response.data.message;
                                vm.errors = e.response.data.errors;
                            } else {
                                vm.text = 'Failed to create admin';
                            }
                            vm.success = false;
                            vm.snackbar = true;
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>