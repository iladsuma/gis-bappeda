@extends('layouts.backend.app')
@section('title', 'Administrator-Role')
{{-- @section('breadcrumb', 'Dashboard') --}}
@section('content')
    @include('backend.admin-role.html')
@endsection
@section('extra_javascript')
    @include('backend.admin-role.javascript')
@endsection
