@extends('layouts.app')

@section('title')
    Remedial Registration
@endsection

@section('page_css')
    <link rel="stylesheet" type="text/css" href="{{ url('css/mdb/mdb.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/mdb/style.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('css/mdb/demo.css') }}"> --}}
@endsection

@section('content')
    @include('partials.auth.remedial')
@endsection

@section('page_js')
    {{-- mdb --}}
    <script src="{{ asset('js/mdb/mdb.min.js') }}"></script>
    {{-- <script src="{{ asset('js/mdb/jquery.validate.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/mdb/jquery-2.2.4.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/mdb/jquery.bootstrap.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/mdb/bootstrap.min.js') }}"></script> --}}

@endsection
