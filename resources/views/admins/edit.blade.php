@extends('layouts.app')

@section('content')
    <v-container>
        <v-layout>
            <v-flex class="my-4">
                <h2 class="text-center">Edit Admin</h2>
            </v-flex>
        </v-layout>
        <v-layout>
            <admin-edit :admin="{{ $admin }}" :roles="{{ $roles }}"></admin-edit>
        </v-layout>
    </v-container>
@endsection