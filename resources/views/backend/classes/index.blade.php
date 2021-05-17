@extends('layouts.master')

@section('title')
    Manage Classes
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
                    <h1 class="m-0">Classes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('classes.create') }}" class="btn btn-outline-success">
                            Create Classes <i class="fas fa-th-list"></i>
                        </a>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li> --}}
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
                        {{-- <h3 class="card-title">Classes' Table</h3> --}}
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
                    @if ($classes->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Students</th>
                                    <th>Teacher</th>
                                    <th>Subject Code</th>
                                    <th>Registered At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($classes as $class)
                                <tbody>
                                    <tr>
                                        <td>{{ $class->class_numeric }}</td>

                                        <td>{{ $class->class_name }}</td>
                                        <td>
                                            <span class="badge badge-info badge-sm">
                                                {{ $class->students_count }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $class->teacher->user->first_name . ' ' . $class->teacher->user->last_name ?? 'No Teacher Assigned' }}
                                        </td>

                                        <td>
                                            @foreach ($class->subjects as $subject)
                                                <span class="badge badge-info badge-sm">
                                                    {{ $subject->subject_code ?? 'No Subjects' }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>{{ $class->created_at }}</td>

                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="{{ route('classes.edit', $class->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-4">
                                                    <a href="{{ route('class.assign.subject', $class->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-list-ol"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-danger btn-sm" id="delModBtn"
                                                        {{-- onclick="handleDelete({{ $class->id }})" --}}
                                                        data-url="{{ route('classes.destroy', $class->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                @include('backend.modals.delete',['name' => 'class'])

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Classes found
                                </h6>

                                <a href="{{ route('classes.create') }}" class="btn btn-outline-success">
                                    Create Classes <i class="fas fa-th-list"></i>
                                </a>
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
            $("#delModBtn").on("click", function(e) {
                e.preventDefault();
                $("#deleteModal").modal("show");
                var url = $(this).attr('data-url');
                $("#deleteForm").attr("action", url);
            })


        })

    </script>
@endpush
