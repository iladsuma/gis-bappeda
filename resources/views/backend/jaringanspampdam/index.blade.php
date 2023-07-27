@extends('layouts.backend.app')
@section('title', 'Data Opd')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.jaringanspampdam.html')
@endsection
@section('extra_javascript')
    @include('backend.jaringanspampdam.javascript')
@endsection
