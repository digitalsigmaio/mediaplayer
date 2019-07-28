<template>
    <v-flex xs6 offset-3>
        <v-layout row wrap>
            <v-flex xs12>
                <h3 class="my-4">Account Settings</h3>
            </v-flex>
            <v-flex xs12>
                <v-card class="my-4">
                    <v-card-text>
                        <v-form v-model="valid" ref="form1">

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

                            <v-select
                                    v-model="roleId"
                                    :items="roles"
                                    item-text="name"
                                    item-value="id"
                                    :value="roleId"
                                    :rules="roleRules"
                                    label="Role"
                                    required
                            ></v-select>

                            <v-btn  @click="update" class="ml-0 mt-2">
                                Update
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
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex xs12>
                <h3 class="my-4">Change Password</h3>
            </v-flex>
            <v-flex xs12>
                <v-card class="my-4">
                    <v-card-text>
                        <v-form v-model="valid" ref="form2">

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

                            <v-btn  @click="changePassword" class="ml-0 mt-2">
                                Change Password
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
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
    export default {
        props: {
            roles: {
                type: Array,
                required: true
            },
            admin: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                valid: false,
                name: this.admin.name,
                nameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length <= 30) || 'Name must be less than 30 characters'
                ],
                email: this.admin.email,
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                password: '',
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => (v && v.length >= 6) || 'Password can\'t be less than 6 characters'
                ],
                roleId: this.admin.role_id,
                roleRules: [
                    v => !!v || 'Role is required'
                ],
                errors: {},
                snackbar: false,
                text: '',
                success: true,
                showPassword: false
            }
        },
        methods: {
            update() {
                if (this.$refs.form1.validate()) {
                    this.updateRequest(
                        {
                            name: this.name,
                            email: this.email,
                            roleId: this.roleId
                        }
                    )
                }
            },
            changePassword() {
                if (this.$refs.form2.validate()) {
                    this.updateRequest(
                        {
                            password: this.password,
                        },
                        'form2'
                    )
                }
            },
            updateRequest(data, form = null) {
                const vm = this;
                axios.patch(`/admins/${vm.admin.id}/edit`, data)
                    .then(res => {
                        vm.errors = {};
                        vm.text = res.data;
                        vm.success = true;
                        vm.snackbar = true;
                        if (form) {
                            vm.$refs[form].reset();
                        }
                    })
                    .catch(e => {
                        if (e.response.status === 422) {
                            vm.text = e.response.data.message;
                            vm.errors = e.response.data.errors;
                        } else {
                            vm.text = e.response.data;
                        }

                        vm.success = false;
                        vm.snackbar = true;
                    });
            }
        }
    }
</script>

<style scoped>

</style>