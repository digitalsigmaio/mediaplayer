@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout justify-center class="my-4">
            <h1>Edit Track</h1>
        </v-layout>
        <v-layout justify-center>
            <v-flex xs6>
                <form action="{{ route('tracks.update', $track) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="albums">Album</label>
                        <select name="album_id" id="albums" class="form-control" required>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ $album->id === $track->album_id ? 'selected' : '' }}>{{ $album->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title" class="label">
                            Title
                        </label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $track->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="audio" class="label">
                            Audio
                        </label>
                        <input id="audio" type="file" class="form-control" name="audio">
                    </div>

                    <div class="form-group">
                        <label for="ringtone" class="label">
                            Ringtone
                        </label>
                        <input id="ringtone" type="file" class="form-control" name="ringtone">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 col-xs-6">
                                <label for="vodafone" class="label">
                                    Vodafone
                                </label>
                                <input id="vodafone" type="text" class="form-control" name="vodafone"
                                       value="{{ $track->vodafone }}" >
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label for="orange" class="label">
                                    Orange
                                </label>
                                <input id="orange" type="text" class="form-control" name="orange"
                                       value="{{ $track->orange }}">
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <label for="etisalat" class="label">
                                    Etisalat
                                </label>
                                <input id="etisalat" type="text" class="form-control" name="etisalat"
                                       value="{{ $track->etisalat }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </v-flex>
        </v-layout>

        <v-layout>
            @include('partials.errors')
            @include('partials.success')
        </v-layout>
    </v-container>
@endsection