@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Create Video</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('videos.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="id" class="label">
                            Video ID
                        </label>
                        <input type="text" class="form-control" name="id" id="id" value="{{ old('id') }}" placeholder="Example: IJzHSYjR0dE" required>
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