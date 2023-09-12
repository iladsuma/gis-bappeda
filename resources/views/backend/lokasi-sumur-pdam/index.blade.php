@extends('layouts.backend.app')
@section('title', 'Data Lokasi Sumur PDAM')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.lokasi-sumur-pdam.html')
@endsection
@section('extra_stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/Control.FullScreen.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet-geoman.css') }}">
@endsection
@section('extra_javascript')
    <script src="{{ asset('assets/leaflet/js/leaflet.js') }}" crossorigin=""></script>
    <script src="{{ asset('assets/leaflet/js/Control.FullScreen.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet-geoman.min.js') }}"></script>
    @include('backend.lokasi-sumur-pdam.javascript')
@endsection
