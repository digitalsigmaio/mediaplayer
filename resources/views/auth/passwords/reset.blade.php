@extends('layouts.guest.app')

@section('content')
    <v-flex xs12 md6>
        <reset-password
                :reset_password="{{ json_encode(__('Reset Password')) }}"
                :route="{{ json_encode(route('password.update')) }}"
                :update_password="{{ json_encode(__('Reset Password')) }}"
                :token="{{ json_encode($token) }}"
        ></reset-password>
    </v-flex>
@endsection
