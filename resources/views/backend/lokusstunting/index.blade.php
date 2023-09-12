@extends('layouts.backend.app')
@section('title', 'Lokus Stunting')
<!-- @section('breadcrumb', 'Dashboard') -->
@section('content')
    @include('backend.lokusstunting.html')
@endsection
@section('extra_javascript')
    @include('backend.lokusstunting.javascript')
@endsection
