@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Edit Video</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('videos.update', $video) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="id" class="label">
                            Video ID
                        </label>
                        <input type="text" class="form-control" name="id" id="id" value="{{ $video->id }}" required>
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