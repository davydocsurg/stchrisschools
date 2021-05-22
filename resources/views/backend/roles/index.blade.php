@extends('layouts.master')

@section('title')
    Manage Roles & Permissions
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
                    <h1 class="m-0"> Manage Roles & Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('role.create') }}" class="btn btn-outline-success" data-toggle="tooltip"
                            data-placement="top" title="Create New Roles">
                            <i class="fas fa-folder-plus"></i> Roles
                        </a>

                        <a href="{{ route('permission.create') }}" class="ml-3 btn btn-outline-success"
                            data-toggle="tooltip" data-placement="top" title="Create New Permissions">
                            <i class="fas fa-folder-plus"></i> Permissions
                        </a>
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
                    @if ($roles->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Roles</th>
                                    <th>Permissions</th>
                                    {{-- <th>Teacher</th>
                                    <th>Subject Code</th>
                                    <th>Registered At</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($roles as $role)
                                <tbody>
                                    <tr>
                                        <td>{{ $role->id }}</td>

                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-info badge-sm">
                                                    {{ $permission->name ?? 'No Permissions' }}
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <div class="col-md-4">
                                                <a href="{{ route('role.edit', $role->id) }}"
                                                    class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="Edit Role">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                                {{-- @include('backend.modals.delete',['name' => 'class']) --}}

                            @endforeach

                        @else
                            <div class="p-5 text-center">
                                <h6 class="display-4 text-dark ">
                                    No Roles found
                                </h6>

                                <a href="{{ route('role.create') }}" class="btn btn-outline-success">
                                    Create Roles <i class="fas fa-user-tag"></i>
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
