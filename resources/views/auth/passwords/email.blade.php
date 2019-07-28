@extends('layouts.guest.app')

@section('content')
    <v-flex xs12 md6>
        <forgot-password
                :reset_password="{{ json_encode(__('Reset Password')) }}"
                :route="{{ json_encode(route('password.email')) }}"
                :send_password="{{ json_encode(__('Send Password Reset Link')) }}"
        ></forgot-password>
    </v-flex>
@endsection
