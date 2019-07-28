@extends('layouts.app')

@section('content')

    <v-container>
        <v-layout>
            <v-flex class="my-4">
                <h2 class="text-center">Create Admin</h2>
            </v-flex>
        </v-layout>
        <v-layout>
            <v-flex xs6 offset-3>
                <admin-create :roles="{{ $roles }}"></admin-create>
            </v-flex>
        </v-layout>
    </v-container>

@endsection