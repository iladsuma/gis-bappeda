@extends('layouts.backend.app')
@section('title', 'Data Opd')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.lokasi-spam.html')
@endsection
@section('extra_javascript')
    @include('backend.lokasi-spam.javascript')
@endsection
