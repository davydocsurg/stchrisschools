@extends('layouts.master')

@section('title')
    Edit Permission - {{ $permission->name }}
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
                    <h1 class="m-0">Edit Permission - {{ $permission->name }}</h1>
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
                        <h3 class="card-title">Edit Permission</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="updatePermissionForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="class name">Permission Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="permissionName"
                                        name="name" placeholder="Permission Name" required
                                        value="{{ $permission->name }}">
                                    <span class="text-danger" id="permissionNameError"></span>
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
                                                    name="selected_roles[]" @foreach ($permission->roles as $item) {{ $item->id === $role->id ? 'checked' : '' }} @endforeach>

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
                                    {{ __('Update') }}
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
            $('#updatePermissionForm').submit(el => {
                el.preventDefault();
                updatePermission(el)

            })
        })

        function updatePermission(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('permission.update', $permission->id) }}`
            goPost(url, data)
                .then(res => {
                    location.href = `{{ route('roles-permissions.index') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#permissionNameError').html(err.message.permissionName[0]);;
            $('#selectedRolesError').html(err.message.selected_permission[0]);

        }

    </script>

@endpush
