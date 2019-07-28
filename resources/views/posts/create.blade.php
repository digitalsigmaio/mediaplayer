@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Create Post</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="label">
                            Title
                        </label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="body" class="label">
                            Body
                        </label>
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Post Featured Image
                        </label>
                        <input id="image" type="file" class="form-control" name="image" required>
                    </div>

                    <div class="form-group">
                        <input id="notify" type="checkbox" class="checkbox mt-2 mr-1" name="notify">
                        <label for="notify" class="label">
                            Notify Users
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </v-flex>
        </v-layout>
        @if($errors->any() || session()->has('error') )
            @include('partials.errors')
        @endif
    </v-container>
@endsection