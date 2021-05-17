@extends('layouts.master')

@section('title')
    Create Subjects
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
                    <h1 class="m-0">Create Subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('subjects.index') }}" class="btn btn-outline-primary">
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
                        <h3 class="card-title">Create Subjects</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="createClassForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject name">Subject Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="className"
                                        name="subject_name" placeholder="Subject Name" required>
                                    <span class="text-danger" id="className"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject number">Subject Code<code>*</code></label>
                                    <input type="number" class="form-control form-control-border" id="subjectCode"
                                        name="subject_code" placeholder="Subject Code" required>
                                    <span class="text-danger" id="subjectCode"></span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="Teacher">Assign Teacher<code>*</code></label>
                                    <select name="teacher_id" class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select Teacher--</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">
                                                {{ $teacher->user->first_name . ' ' . $teacher->user->last_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger" id="selectTeacher"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Subject Description">Subject Description<code>*</code></label>
                                    <input type="text" name="subject_description" class="form-control form-control-border"
                                        id="">

                                    <span class="text-danger" id="subjectDescription"></span>

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
            let errors = []

            $('#createClassForm').submit(el => {
                el.preventDefault();
                createClass(el)

            })
        })

        function createClass(el) {
            offError()
            sendReq()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('subjects.store') }}`

            goPost(url, data)
                .then(res => {
                    // console.log(data);
                    location.href = `{{ route('subjects.index') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#subjectName').html(err.message.subject_name[0]);
            $('#subjectCode').html(err.message.subject_numeric[0]);
            $('#selectTeacher').html(err.message.teacher_id[0]);
            $('#subjectDescription').html(err.message.subject_description[0]);

        }

    </script>

@endpush
