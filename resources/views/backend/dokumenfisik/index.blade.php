@extends('layouts.backend.app')
@section('title', 'Dokumen Fisik')
@section('breadcrumb', 'Dokumen Fisik')
@section('content')
    @include('backend.dokumenfisik.html')
@endsection
@section('extra_javascript')
    @include('backend.dokumenfisik.javascript')
@endsection
