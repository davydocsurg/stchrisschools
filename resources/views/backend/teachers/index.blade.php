@extends('layouts.master')

@section('title')
    Manage Teachers
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
                    <h1 class="m-0">Teachers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('teachers.create') }}" class="btn btn-outline-success">
                            Create Teacher <i class="fas fa-chalkboard-teacher"></i>
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
                        <h3 class="card-title">Teachers' Table</h3>
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
                    @if ($teachers->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>D.O.B</th>
                                    <th>Current Address</th>
                                    <th>Permanent Address</th>
                                    <th>Registered At</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @foreach ($teachers as $teacher)
                                <tbody>
                                    <tr>
                                        <td>{{ $teacher->user->id }}</td>
                                        <td>{{ $teacher->user->first_name . ' ' . $teacher->user->last_name }}</td>
                                        <td>{{ $teacher->user->email }}</td>
                                        <td>{{ $teacher->user->phone }}</td>
                                        <td>{{ $teacher->user->date_of_birth }}</td>
                                        <td>{{ $teacher->user->current_address }}</td>
                                        <td>{{ $teacher->user->permanent_address }}</td>
                                        <td>{{ $teacher->user->created_at }}</td>
                                        <td><span class="tag tag-success">Approved</span></td>

                                    </tr>

                                </tbody>
                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Teachers found
                                </h6>

                                <a href="{{ route('teachers.create') }}" class="btn btn-outline-success">
                                    Create Teacher <i class="fas fa-chalkboard-teacher"></i>
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
