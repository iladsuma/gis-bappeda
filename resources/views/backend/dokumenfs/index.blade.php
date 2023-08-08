@extends('layouts.backend.app')
@section('title', 'Dokumen Feasibility Study')
@section('breadcrumb', 'Dokumen Feasibility Study')
@section('content')
    @include('backend.dokumenfs.html')
@endsection
@section('extra_javascript')
    @include('backend.dokumenfs.javascript')
@endsection
