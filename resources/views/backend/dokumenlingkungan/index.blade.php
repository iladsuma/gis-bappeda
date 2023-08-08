@extends('layouts.backend.app')
@section('title', 'Dokumen Lingkungan')
@section('breadcrumb', 'Dokumen Lingkungan')
@section('content')
    @include('backend.dokumenlingkungan.html')
@endsection
@section('extra_javascript')
    @include('backend.dokumenlingkungan.javascript')
@endsection
