@extends('layouts.master')

@section('title')
    Manage Subjects
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
                    <h1 class="m-0">Subjects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('subjects.create') }}" class="btn btn-outline-success">
                            Create Subjects <i class="fas fa-align-center"></i>
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
                    @if ($subjects->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Teachers</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($subjects as $subject)
                                <tbody>
                                    <tr>
                                        <td>{{ $subject->id }}</td>

                                        <td>{{ $subject->subject_name }}</td>
                                        <td>
                                            <span class="badge badge-info badge-sm">
                                                {{ $subject->subject_code }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $subject->teacher->user->first_name . ' ' . $subject->teacher->user->last_name ?? 'No Teacher Assigned' }}
                                        </td>

                                        <td>
                                            {{ $subject->subject_description }}
                                        </td>

                                        <td>{{ $subject->created_at }}</td>

                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="{{ route('subjects.edit', $subject->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-4">
                                                    <button class="btn btn-danger btn-sm delModBtn" id="delModBtn"
                                                        {{-- onclick="handleDelete({{ $subject->id }})" --}}
                                                        data-url="{{ route('subjects.destroy', $subject->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                @include('backend.modals.delete',['name' => 'subject'])

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Subjects found
                                </h6>

                                <a href="{{ route('subjects.create') }}" class="btn btn-outline-success">
                                    Create Subjects <i class="fas fa-align-center"></i>
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
            $(".delModBtn").on("click", function(e) {
                e.preventDefault();
                $("#deleteModal").modal("show");
                var url = $(this).attr('data-url');
                $("#deleteForm").attr("action", url);
            })


        })

    </script>
@endpush
