@extends('layouts.master')

@section('title')
    Create Lessons
@endsection

<style>
    @media screen and (max-width:360px) {
        .card-tools {
            margin-top: 1.2rem !important;
        }
    }

</style>

@section('page_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Lessons</h1>
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
                <div class="card-header row">
                    <div class=" col-md-6 col-sm-12">
                        <h3 class="card-title">Create Lessons</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="createLessonForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Lesson Title">Lesson Title<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="lessonTitle"
                                        name="lesson_title" placeholder="Lesson Title" required>
                                    <span class="text-danger" id="lessonTitleError"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Lesson Description">Lesson Description<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="lessonDescription"
                                        name="lesson_description" placeholder="Lesson Description" required>

                                    <span class="text-danger" id="lessonDescriptionError"></span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="Lesson Video">Lesson Video</label>
                                    <input type="file" name="lesson_video" class="form-control form-control-border"
                                        id="lessonVideo">

                                    <span class="text-danger" id="lessonVideoError"></span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Class">Assign Class<code>*</code></label>
                                    <select name="class_id" class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select Class--</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">
                                                {{ $class->class_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger" id="selectClassError"></span>
                                </div>
                            </div>

                        </div>

                        <div class="form-group text-center row mb-0 mt-3">
                            <div class="col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                    <span class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"
                                        style="display: none"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            $('#createLessonForm').submit(el => {
                el.preventDefault();
                createLesson(el)

            })
        })

        function createLesson(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('lessons.store') }}`

            goPost(url, data)
                .then(res => {
                    location.href = `{{ route('lessons.index') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#lessonTitleError').html(err.message.lesson_title[0]);
            $('#lessonDescriptionError').html(err.message.subject_numeric[0]);
            $('#lessonVideoError').html(err.message.teacher_id[0]);

        }

    </script>

@endpush
