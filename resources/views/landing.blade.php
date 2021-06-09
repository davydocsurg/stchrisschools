@extends('welcome')

@section('page_title')
    Welcome
@endsection

@section('content')

    @include('partials.landing.banner')

    @include('partials.landing.about')

    @include('partials.landing.teachers')
    @include('partials.landing.services')
    @include('partials.landing.contact')
@endsection
