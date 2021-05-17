@extends('layouts.master')

@section('title')
    Assign Subjects
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
                    <h1 class="m-0">Assign Subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('classes.index') }}" class="btn btn-outline-primary">
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
                        <h3 class="card-title">Assign Subjects</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($subjects->count() > 0)
                        <form method="post" id="assignSubjectForm">
                            @csrf
                            <div class="form-group">
                                @foreach ($subjects as $subject)
                                    <div class="form-check">
                                        <div class="row justify-content-center">
                                            <label class="form-check-label col-lg-6 font-weight-bold"
                                                for="selectedSubjects">{{ $subject->subject_name }}</label>
                                            <input type="checkbox" class="form-check-input col-lg-6" id="selectedSubjects"
                                                value="{{ $subject->id }}" name="selected_subjects[]" @foreach ($assigned->subjects as $item) {{ $item->id === $subject->id ? 'checked' : '' }} @endforeach>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="text-danger" id="assignSubjectError"></span>

                            </div>



                            <div class="form-group text-center row mb-0 mt-5">
                                <div class="col-lg-6 offset-lg-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Assign') }}
                                        <span class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"
                                            style="display: none"></span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    @else
                        <div class="p-5 text-center">
                            <h6 class="display-4 text-dark ">
                                No Subjects found
                            </h6>

                            <a href="{{ route('subjects.create') }}" class="btn btn-outline-success">
                                Create Subject <i class="fas fa-align-center"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            let errors = []

            $('#assignSubjectForm').submit(el => {
                el.preventDefault();
                assignSubject(el)

            })
        })

        function assignSubject(el) {
            offError()
            sendReq()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('store.class.assign.subject', $classId) }}`

            goPost(url, data)
                .then(res => {
                    // console.log(data);
                    location.href = `{{ route('classes.index') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#assignSubjectError').html(err.message.subject_name[0]);
        }

    </script>

@endpush
