@extends('layouts.backend-dashboard.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('backend.dashboard.html')
@endsection
@section('extra_javascript')
    @include('backend.dashboard.javascript')
@endsection
