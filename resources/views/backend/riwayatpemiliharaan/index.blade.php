@extends('layouts.backend.app')
@section('title', 'Data Opd')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.riwayatpemiliharaan.index')
@endsection
@section('extra_javascript')
    @include('backend.riwayatpemiliharaan.javascript')
@endsection
