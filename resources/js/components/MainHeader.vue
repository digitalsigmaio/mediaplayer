<template>
    <header>
        <slot></slot>
        <v-toolbar
                color="pink darken-1"
                dark
                dense
                fixed
                clipped-left
                app
        >
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-icon class="mx-3">fas fa-music</v-icon>
            <v-toolbar-title class="mr-5 align-center">
                <span class="title">{{ appname }}</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <auth-tile @logout="logout" @account="userAccount" :admin="admin"></auth-tile>
        </v-toolbar>
    </header>
</template>

<script>
    export default {
        props: {
            appname: {
                type: String
            },
            admin: {
                required: true,
                type: Object
            }
        },
        data: () => ({
            drawer: null,
        }),
        methods: {
            logout() {
                axios.post('/admin/logout')
                    .then((res) => {
                        window.location.href = '/';
                    });
            },
            userAccount(id) {
                window.location.href = '/account';
            }
        },
        watch: {
            drawer(val) {
                app.__vue__.drawer = val;
            }
        }
    }
</script>

<style scoped>

</style>