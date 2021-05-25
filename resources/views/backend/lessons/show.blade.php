@extends('layouts.master')

@section('title')
    Lesson - {{ $lesson->lesson_title }}
@endsection

<style>
    .lesson_video {
        max-width: 33rem !important;
    }

</style>

@section('page_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Lesson - {{ $lesson->lesson_title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('lessons.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-long-arrow-alt-left"></i> Back
                            </a>
                        </li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            Title:
                        </div>
                        <div class="col-lg-8">
                            <h3 class="">{{ $lesson->lesson_title }}</h3>
                        </div>
                    </div>

                    @if ($lesson->lesson_video)
                        <div class="row">
                            <div class="col-lg-4">
                                Video:
                            </div>
                            <div class="col-lg-8">
                                <video class="vid-width lesson_video" controls v-scrollAnime>
                                    <source src="{{ url('storage/lessons/videos/' . $lesson->lesson_video) }}"
                                        type="video/mp4" />

                                    <source src="{{ url('storage/lessons/videos/' . $lesson->lesson_video) }}"
                                        type="video/ogg" />
                                </video>
                            </div>
                        </div>
                    @endif

                    <div class="row my-3">
                        <div class="col-lg-4">
                            Description:
                        </div>
                        <div class="col-lg-8">
                            <p class="">{{ $lesson->lesson_description }}</p>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-lg-4">
                            Created At:
                        </div>
                        <div class="col-lg-8">
                            <p class="">{{ $lesson->created_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
