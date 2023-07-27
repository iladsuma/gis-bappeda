@extends('layouts.backend.app')
@section('title', 'Data Kawasan Kumuh')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('backend.datakawasankumuh.html')
@endsection
@section('extra_javascript')
    @include('backend.datakawasankumuh.javascript')
@endsection