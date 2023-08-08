@extends('layouts.backend.app')
@section('title', 'Dokumen Master Plan')
@section('breadcrumb', 'Dokumen Master Plan')
@section('content')
    @include('backend.dokumenmp.html')
@endsection
@section('extra_javascript')
    @include('backend.dokumenmp.javascript')
@endsection
