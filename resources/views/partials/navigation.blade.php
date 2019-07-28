<v-navigation-drawer
        v-model="drawer"
        fixed
        clipped
        app
        xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-layout column justify-center align-center class="my-4">
        <v-flex>
            <v-avatar class="my-4" size="200px">
                <img src="{{ $artist->img ?? asset('assets/img/default.png') }}" alt="{{ $artist->name ?? 'Naghmaty' }}">
            </v-avatar>
        </v-flex>
        <v-flex>
            <div class="subheading pa-3">{{ $artist->name ?? 'Naghmaty' }}</div>
        </v-flex>
    </v-layout>
    <v-list dense>

        <v-list-tile @click="router({{ json_encode(route('dashboard')) }})">
            <v-list-tile-action>
                <v-icon>dashboard</v-icon>
            </v-list-tile-action>

            <v-list-tile-content>
                <v-list-tile-title>Home</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-list-group>
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>library_music</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Albums</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>

            <v-list-tile @click="router({{ json_encode(route('albums.index')) }})">
                <v-list-tile-action>
                    <v-icon>view_list</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>List</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('albums.create')) }})">
                <v-list-tile-action>
                    <v-icon>create</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Create</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('albums.trash')) }})">
                <v-list-tile-action>
                    <v-icon>delete</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Trash</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

        </v-list-group>

        <v-list-group>
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>music_note</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Tracks</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>

            <v-list-tile @click="router({{ json_encode(route('tracks.index')) }})">
                <v-list-tile-action>
                    <v-icon>view_list</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>List</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('tracks.create')) }})">
                <v-list-tile-action>
                    <v-icon>create</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Create</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="router({{ json_encode(route('tracks.trash')) }})">
                <v-list-tile-action>
                    <v-icon>delete</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Trash</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-group>

        <v-list-group>
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>collections</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Gallery</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>

            <v-list-tile @click="router({{ json_encode(route('gallery-images.index')) }})">
                <v-list-tile-action>
                    <v-icon>view_list</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>List</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('gallery-images.create')) }})">
                <v-list-tile-action>
                    <v-icon>create</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Create</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="router({{ json_encode(route('gallery-images.trash')) }})">
                <v-list-tile-action>
                    <v-icon>delete</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Trash</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-group>

        <v-list-group>
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>description</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>News</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>

            <v-list-tile @click="router({{ json_encode(route('posts.index')) }})">
                <v-list-tile-action>
                    <v-icon>view_list</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>List</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('posts.create')) }})">
                <v-list-tile-action>
                    <v-icon>create</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Create</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-list-tile @click="router({{ json_encode(route('posts.trash')) }})">
                <v-list-tile-action>
                    <v-icon>delete</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Trash</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-group>

        <v-list-group>
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>public</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Social Pages</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>

            <v-list-tile @click="router({{ json_encode(route('social-pages.index')) }})">
                <v-list-tile-action>
                    <v-icon>view_list</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>List</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('social-pages.create')) }})">
                <v-list-tile-action>
                    <v-icon>create</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Create</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-group>

        <v-list-group>
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon>video_library</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Videos</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>

            <v-list-tile @click="router({{ json_encode(route('videos.index')) }})">
                <v-list-tile-action>
                    <v-icon>view_list</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>List</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="router({{ json_encode(route('videos.create')) }})">
                <v-list-tile-action>
                    <v-icon>create</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Create</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-group>

        @can('create', \App\Admin::class)
            <v-list-group>
                <template v-slot:activator>
                    <v-list-tile class="mt-3">
                        <v-list-tile-action>
                            <v-icon color="grey darken-1">people</v-icon>
                        </v-list-tile-action>

                        <v-list-tile-content>
                            <v-list-tile-title class="grey--text text--darken-1">Admins</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
                <v-list-tile @click="router({{ json_encode(route('admins.index')) }})" class="mt-3">
                    <v-list-tile-action>
                        <v-icon color="grey darken-1">view_list</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title class="grey--text text--darken-1">List</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="router({{ json_encode(route('admins.create')) }})" class="mt-3">
                    <v-list-tile-action>
                        <v-icon color="grey darken-1">add</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title class="grey--text text--darken-1">Create</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list-group>
        @endif

    </v-list>
</v-navigation-drawer>