@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Update Social Network Link</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('social-pages.update', $socialPage) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="provider" class="label">
                            Social Network
                        </label>
                        <input id="provider" type="text" class="form-control" name="provider" value="{{ $socialPage->provider }}" required>
                    </div>

                    <div class="form-group">
                        <label for="link" class="label">
                            Link
                        </label>
                        <input type="text" class="form-control" name="link" id="link" value="{{ $socialPage->link }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Icon
                        </label>
                        <input id="image" type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </v-flex>
        </v-layout>
        <v-layout justify-center>
            @include('partials.errors')
            @include('partials.success')
        </v-layout>
    </v-container>
@endsection