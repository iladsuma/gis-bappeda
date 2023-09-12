@extends('layouts.backend.app')
@section('title', 'Data Kemiskinan')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.lokuskemiskinan.html')
@endsection
@section('extra_javascript')
    @include('backend.lokuskemiskinan.javascript')
@endsection
