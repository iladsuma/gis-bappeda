@extends('layouts.backend.app')
@section('title', 'Data Kelurahan')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('backend.datakelurahan.html')
@endsection
@section('extra_javascript')
    @include('backend.datakelurahan.javascript')
@endsection