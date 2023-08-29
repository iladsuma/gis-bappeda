@extends('layouts.backend.app')
@section('title', 'Administrator-User')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.admin-user.html')
@endsection
@section('extra_javascript')
    @include('backend.admin-user.javascript')
@endsection
