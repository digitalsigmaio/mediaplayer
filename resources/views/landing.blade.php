@extends('layouts.guest.app')

@section('content')
    <v-flex xs12 md6>
        <login-form
                :route="{{ json_encode(route('admin.login')) }}"
                :has_request="{{ Route::has('admin.password.request') }}"
                :password_request="{{ json_encode(route('admin.password.request')) }}"
                :forgot_password="{{ json_encode(__('Forgot Your Password?')) }}">

        </login-form>
    </v-flex>
@endsection
