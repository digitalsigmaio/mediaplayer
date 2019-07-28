@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Create Album</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('albums.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="label">
                            Title
                        </label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="year" class="label">
                            Year
                        </label>
                        <input id="year" type="month" min="1970-01" max="{{ date('Y', time()) }}-12"
                               class="form-control" name="year" value="{{ old('date') ?? '2019-01'}}" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Album Cover
                        </label>
                        <input id="image" type="file" class="form-control" name="image" required>
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