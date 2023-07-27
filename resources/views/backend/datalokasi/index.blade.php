@extends('layouts.backend.app')
@section('title', 'Data Lokasi')
@section('breadcrumb', 'Dashboard')
@section('content')
    @include('backend.datalokasi.html')
@endsection
@section('extra_javascript')
    @include('backend.datalokasi.javascript')
@endsection