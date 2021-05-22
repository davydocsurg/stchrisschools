@extends('layouts.master')

@section('title')
    Create Permissions & Assign Roles
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
                    <h1 class="m-0">Create Permissions & Assign Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        {{-- <li class="breadcrumb-item"> --}}
                        <a href="{{ route('roles-permissions.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-long-arrow-alt-left"></i> Back
                        </a>
                        {{-- </li> --}}

                        <a href="{{ route('role.create') }}" class="ml-3 btn btn-outline-success" data-toggle="tooltip"
                            data-placement="top" title="Create New Roles">
                            <i class="fas fa-folder-plus"></i> Roles
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
                        <h3 class="card-title">Create Permissions</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="createPermissionForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="class name">Permission Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="permissionName"
                                        name="name" placeholder="Permission Name" required>
                                    <span class="text-danger" id="PermissionNameError"></span>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Assign Roles</label>
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <div class="row justify-content-center">
                                                <label class="form-check-label col-lg-6 font-weight-bold"
                                                    for="selectedPermissions">{{ $role->name }}</label>
                                                <input type="checkbox" class="form-check-input col-lg-6"
                                                    id="selectedPermissions" value="{{ $role->name }}"
                                                    name="selected_roles[]">
                                            </div>
                                        </div>
                                    @endforeach
                                    <span class="text-danger" id="selectedRolesError"></span>

                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row mb-0 mt-3">
                            <div class="col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                    <span class="spinner-border spinner-border-sm mb-1" Permission="status"
                                        aria-hidden="true" style="display: none"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- permissions table --}}

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
                    @if ($permissions->count() > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach ($permissions as $permission)
                                <tbody>
                                    <tr>
                                        <td>{{ $permission->id }}</td>

                                        <td>{{ $permission->name }}</td>

                                        <td>
                                            <div class="col-md-4">
                                                <a href="{{ route('permission.edit', $permission->id) }}"
                                                    class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="Edit Permission">
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
                                    No Permissions found
                                </h6>

                                <a href="{{ route('permission.create') }}" class="btn btn-outline-success">
                                    Create Permissions <i class="fas fa-user-tag"></i>
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
        $(document).ready(() => {
            $('#createPermissionForm').submit(el => {
                el.preventDefault();
                createPermission(el)

            })
        })

        function createPermission(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('permission.store') }}`
            goPost(url, data)
                .then(res => {
                    // location.href = `{{ route('roles-permissions.index') }}`
                    location.reload();
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#PermissionNameError').html(err.message.permissionName[0]);;
            $('#selectedRolesError').html(err.message.selected_permission[0]);

        }

    </script>

@endpush
