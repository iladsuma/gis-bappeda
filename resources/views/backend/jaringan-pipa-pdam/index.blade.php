@extends('layouts.backend.app')
@section('title', 'Jaringan Pipa PDAM')
@section('breadcrumb', 'Jaringan Pipa PDAM')
@section('content')
    @include('backend.jaringan-pipa-pdam.html')
@endsection
@section('extra_javascript')
    @include('backend.jaringan-pipa-pdam.javascript')
@endsection
