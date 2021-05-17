@extends('layouts.master')

@section('title')
    Manage Students
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
                    <h1 class="m-0">Students</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('students.create') }}" class="btn btn-outline-success">
                            Create Students <i class="fas fa-user-graduate"></i>
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
                    @if ($students->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    {{-- <th>Children</th> --}}
                                    {{-- <th>D.O.B</th>
                                    <th>Current Address</th>
                                    <th>Permanent Address</th> --}}
                                    <th>Registered At</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($students as $student)
                                <tbody>
                                    <tr>
                                        <td>{{ $student->user->id }}</td>
                                        <td>
                                            <div class="image">
                                                <img src="{{ url('storage/users/profile/' . $student->user->profile_picture) }}"
                                                    class="img-circle elevation-2" alt="{{ $student->user->first_name }}"
                                                    width="35">
                                            </div>
                                        </td>
                                        <td>{{ $student->user->first_name . ' ' . $student->user->last_name }}</td>
                                        <td>{{ $student->user->email }}</td>
                                        <td>{{ $student->student_phone }}</td>
                                        {{-- <td>{{ $student->date_of_birth }}</td>
                                        <td>{{ $student->current_address }}</td>
                                        <td>{{ $student->permanent_address }}</td> --}}
                                        <td>{{ $student->created_at }}</td>
                                        <td><span class="tag tag-success">Approved</span></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="{{ route('students.edit', $student->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-6">
                                                    <button class="ml-1 btn btn-danger btn-sm" id="delModBtn"
                                                        {{-- onclick="handleDelete({{ $student->id }})" --}}
                                                        data-url="{{ route('students.destroy', $student->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                @include('backend.modals.delete',['name' => 'student'])

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Students found
                                </h6>

                                <a href="{{ route('students.create') }}" class="btn btn-outline-success">
                                    Create Student <i class="fas fa-user-graduate"></i>
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
