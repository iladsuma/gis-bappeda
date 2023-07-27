@extends('layouts.backend.app')
@section('title', 'Data Infrastruktur')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('backend.datainfrastruktur.html')
@endsection
@section('extra_javascript')
    @include('backend.datainfrastruktur.javascript')
@endsection