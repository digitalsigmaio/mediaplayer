@extends('layouts.app')

@section('content')
<v-container>
    <artist :artistdata="{{ $artist }}" route="{{ route('artist.update') }}" inline-template>
        <v-layout row justify-center align-center>
            <v-flex xs12 sm6 v-if="!edit">
                <v-card>
                    <v-img
                            src="/assets/img/default.jpg"
                            height="300px"
                    >
                        <v-layout
                                column
                                fill-height
                        >
                            <v-card-title>

                                <v-spacer></v-spacer>

                                <v-btn color="pink darken-1" dark fab class="mr-3" @click="edit = !edit">
                                    <v-icon>edit</v-icon>
                                </v-btn>
                            </v-card-title>

                            <v-spacer></v-spacer>

                            <v-card-title class="white--text pl-5 pt-5 artist-header">

                                <img :src="avatar" class="artist-img">

                                <div class="display-1 pl-5 pt-5">@{{ artist.name }}</div>
                            </v-card-title>
                        </v-layout>
                    </v-img>

                    <v-card-title>
                        <div id="about" class="p-3 mt-1">
                            <h4 class="mt-1 mb-3">About</h4>
                            <p>@{{ artist.about }}</p>
                        </div>
                    </v-card-title>
                </v-card>
            </v-flex>
            <v-flex xs12 sm6 v-else>
                <form @submit.prevent="update" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name" class="label">
                            Name
                        </label>
                        <input id="name" type="text" class="form-control" name="name" v-model="name" required>
                    </div>

                    <div class="form-group">
                        <label for="about" class="label">
                            About
                        </label>
                        <textarea name="about" id="about" cols="30" rows="10" class="form-control" v-model="about"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Image
                        </label>
                        <input id="image" type="file" class="form-control" @change="uploadImage">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-primary" @click.prevent="edit = !edit">Cancel</button>
                    </div>
                </form>
            </v-flex>
        </v-layout>
    </artist>
</v-container>
@endsection


