@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Edit Album</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('albums.update', $album) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="title" class="label">
                            Title
                        </label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $album->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="year" class="label">
                            Year
                        </label>
                        <input id="year" type="month" min="1970-01" max="{{ date('Y', time()) }}-12"
                               class="form-control" name="year" value="{{ $album->year . '-01'}}" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Album Cover
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