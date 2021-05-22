@extends('layouts.master')

@section('title')
    Manage & Assign Roles
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
                    <h1 class="m-0">Manage & Assign Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('assign_roles.create') }}" class="btn btn-outline-success">
                            Create & Assign Roles <i class="fas fa-user-tag"></i>
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
                        {{-- <h3 class="card-title">Roles' Table</h3> --}}
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
                    @if ($users->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Registered At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($users as $user)
                                <tbody>
                                    <tr>
                                        <td>{{ $user->id }}</td>

                                        <td>
                                            <div class="image">
                                                <img src="{{ url('storage/users/profile/' . $user->profile_picture) }}"
                                                    class="img-circle elevation-2" alt="{{ $user->first_name }}"
                                                    width="35">
                                            </div>
                                        </td>

                                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>

                                        <td>
                                            {{ $user->email }}
                                        </td>

                                        @foreach ($user->roles as $role)
                                            <td>
                                                <span class="badge badge-info badge-sm">
                                                    {{ $role->name }}
                                                </span>
                                            </td>
                                        @endforeach

                                        <td>{{ $user->created_at }}</td>

                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="{{ route('assign_roles.edit', $user->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>
                                                </div>

                                                {{-- <div class="col-md-6">
                                                    <button class="btn btn-danger btn-sm delModBtn" id="delModBtn"
                                                        data-url="{{ route('assign_roles.destroy', $user->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                {{-- @include('backend.modals.delete',['name' => 'User']) --}}

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Users/Roles found
                                </h6>

                                <a href="{{ route('roles.create') }}" class="btn btn-outline-success">
                                    Create & Assign Roles <i class="fas fa-th-list"></i>
                                </a>
                            </div>

                    @endif
                    </table>
                </div>
                <!-- /.card-body -->

                <!-- card-footer -->
                <div class="card-footer">
                    {{ $users->links() }}

                </div>
                <!-- /.card-footer -->

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
