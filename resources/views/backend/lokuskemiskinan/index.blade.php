@extends('layouts.backend.app')
@section('title', 'Data Opd')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.lokuskemiskinan.html')
@endsection
@section('extra_javascript')
    @include('backend.lokuskemiskinan.javascript')
@endsection
