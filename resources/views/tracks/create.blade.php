@extends('layouts.app')

@section('content')
    <v-container fill-height>
        <v-flex justify-center>
            <h1>Create Track</h1>
        </v-flex>
        <v-layout justify-center align-center>
            <v-flex xs12>
                @if($albums->count())
                    <form action="{{ route('tracks.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="albums">Album</label>
                            <select name="album_id" id="albums" class="form-control" required>
                                <option value="" selected disabled="">Select Album</option>
                                @foreach($albums as $album)
                                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title" class="label">
                                Title
                            </label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="audio" class="label">
                                Audio
                            </label>
                            <input id="audio" type="file" class="form-control" name="audio" required>
                        </div>

                        <div class="form-group">
                            <label for="ringtone" class="label">
                                Ringtone
                            </label>
                            <input id="ringtone" type="file" class="form-control" name="ringtone">
                        </div>

                        <div class="form-group">
                            <input id="notify" type="checkbox" class="checkbox mt-2 mr-1" name="notify">
                            <label for="notify" class="label">
                                Notify Users
                            </label>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-xs-6">
                                    <label for="vodafone" class="label">
                                        Vodafone
                                    </label>
                                    <input id="vodafone" type="text" class="form-control" name="vodafone"
                                           value="{{ old('vodafone') }}">
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <label for="orange" class="label">
                                        Orange
                                    </label>
                                    <input id="orange" type="text" class="form-control" name="orange"
                                           value="{{ old('orange') }}">
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <label for="etisalat" class="label">
                                        Etisalat
                                    </label>
                                    <input id="etisalat" type="text" class="form-control" name="etisalat"
                                           value="{{ old('etisalat') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                    @else
                    <h2 class="text-center grey--text">There's no album created yet</h2>
                @endif
            </v-flex>
        </v-layout>
        @include('partials.errors')
    </v-container>
@endsection