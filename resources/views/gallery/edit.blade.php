@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Update Image</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('gallery-images.update', $galleryImage) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="caption" class="label">
                            Caption
                        </label>
                        <input id="caption" type="text" class="form-control" name="caption" value="{{ $galleryImage->caption }}">
                    </div>

                    <div class="form-group">
                        <label for="image" class="label">
                            Image
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