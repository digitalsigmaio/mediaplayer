@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Create Social Network Link</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('social-pages.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="provider" class="label">
                            Social Network
                        </label>
                        <input id="provider" type="text" class="form-control" name="provider" value="{{ old('provider') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="link" class="label">
                            Link
                        </label>
                        <input type="text" class="form-control" name="link" id="link" value="{{ old('link') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Icon
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