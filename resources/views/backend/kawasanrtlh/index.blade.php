@extends('layouts.backend.app')
@section('title', 'Data RTLH')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.kawasanrtlh.html')
@endsection
@section('extra_javascript')
    @include('backend.kawasanrtlh.javascript')
@endsection
