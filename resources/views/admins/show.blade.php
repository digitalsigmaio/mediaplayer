@extends('layouts.app')

@section('content')
    <v-container fill-height>
        <v-layout justify-center align-center>
            <v-flex class="text-xs-center">
                <div class="display-4 mb-5">
                    Coming Soon
                </div>
                <div class="display-3 pink--text">
                    {{ $admin->name }}
                </div>
            </v-flex>
        </v-layout>
    </v-container>
@endsection