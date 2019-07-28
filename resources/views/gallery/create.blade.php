@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>New Image</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('gallery-images.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image" class="label">
                            Image
                        </label>
                        <input id="image" type="file" class="form-control" name="image" required>
                    </div>


                    <div class="form-group">
                        <label for="caption" class="label">
                            Caption
                        </label>
                        <input id="caption" type="text" class="form-control" name="caption" value="{{ old('caption') }}">
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