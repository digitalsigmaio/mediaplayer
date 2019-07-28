@extends('layouts.app')

@section('content')
    @can('create', \App\Admin::class)
        <admin-list :adminlist="{{ $admins }}"></admin-list>
    @endcan
@endsection


