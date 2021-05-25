@extends('layouts.master')

@section('title')
    Manage Your Classes
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
                    <h1 class="m-0">Your Classes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <a href="{{ route('lessons.create') }}" class="btn btn-outline-success">
                            Create Your Classes <i class="fas fa-book"></i>
                        </a> --}}
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
                        <a class="btn btn-info" onclick="refreshPage()">
                            Refresh <i class="spinner-border spinner-border-sm mb-1 " id="refresh"
                                style="display: none"></i>
                        </a>
                    </div>

                    <div class="card-tools col-md-6 col-sm-12">
                        <div class="input-group input-group-sm  float-right" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if ($teacher_classes->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Classes</th>
                                    <th>Subjects</th>
                                    <th>Students</th>
                                    {{-- <th>Created At</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($teacher_classes as $item)
                                <tbody>
                                    <tr>
                                        <td>{{ $item->id }}</td>

                                        <td>{{ $item->class_name }}</td>

                                        @if ($item->subjects->count() > 0)
                                            <td>
                                                @foreach ($item->subjects as $item->subject)
                                                    <span class="badge badge-info badge-sm">
                                                        {{-- {{ $item->subject_name }} --}}
                                                        {{ $item->subject->subject_name }}
                                                    </span>
                                                @endforeach
                                            </td>

                                        @else
                                            <td>
                                                <span class="badge badge-secondary badge-sm">
                                                    No subjects Found
                                                </span>
                                            </td>
                                        @endif

                                        <td>
                                            @foreach ($item->students as $item->student)
                                                <span class="badge badge-dark badge-sm">
                                                    {{-- {{ $item->students->count() }} --}}
                                                    {{ $item->student->user->first_name . ' ' . $item->student->user->last_name }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <div class="row">
                                                {{-- <div class="col-md-6">
                                                    <a href="{{ route('assigned_classes.show', $item->id) }}"
                                                        class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                        data-placement="top" title="View Class">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div> --}}

                                                <div class="col-md-6">
                                                    <a href="{{ route('lessons.create') }}" class="btn btn-primary btn-sm"
                                                        data-toggle="tooltip" data-placement="top" title="Upload Lessons">
                                                        <i class="fas fa-file-upload"></i>
                                                    </a>
                                                </div>

                                                {{-- <div class="col-md-6">
                                                    <button class="btn btn-danger btn-sm delModBtn" id="delModBtn"
                                                        data-url="{{ route('assigned_classes.destroy', $item->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                {{-- @include('backend.modals.delete',['name' => 'lesson']) --}}

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Classes Assigned
                                </h6>

                                {{-- <a href="{{ route('lessons.create') }}" class="btn btn-outline-success">
                                    Create Lessons <i class="fas fa-book"></i>
                                </a> --}}
                            </div>

                    @endif
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $(".delModBtn").on("click", function(e) {
                e.preventDefault();
                $("#deleteModal").modal("show");
                var url = $(this).attr('data-url');
                $("#deleteForm").attr("action", url);
            })


        })

    </script>
@endpush
