@extends('layouts.backend.app')
@section('title', 'Data OPD')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('backend.dataopd.html')
@endsection
@section('extra_javascript')
    @include('backend.dataopd.javascript')
@endsection