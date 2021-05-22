@extends('layouts.master')

@section('title')
    Edit User & Role - {{ $user->first_name . ' ' . $user->last_name }}
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
                    <h1 class="m-0">Edit User & Role - {{ $user->first_name . ' ' . $user->last_name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('assign_roles.index') }}" class="btn btn-outline-primary">
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
                        <h3 class="card-title">Edit User & Role</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="image text-center mb-3">
                        <img src="{{ url('storage/users/profile/' . $user->profile_picture) }}"
                            class="img-circle elevation-2" width="120"
                            alt="{{ $user->first_name . ' ' . $user->last_name }}">
                    </div>

                    <form method="post" id="updateUser">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user first name">User First Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="userFirstName"
                                        name="first_name" placeholder="User First Name" required
                                        value="{{ $user->first_name }}">
                                    <span class="text-danger" id="userFirstNameError"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user first name">User Last Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="userLastName"
                                        name="last_name" placeholder="User Last Name" required
                                        value="{{ $user->last_name }}">
                                    <span class="text-danger" id="userLastNameError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="user Email">User Email<code>*</code></label>
                                    <input type="email" class="form-control form-control-border" id="userEmail" name="email"
                                        placeholder="User Last Name" required value="{{ $user->email }}">

                                    <span class="text-danger" id="userEmailError"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="User Password">User Password</label>
                                    <input type="password" name="password" class="form-control form-control-border" id=""
                                        value="{{ $user->password }}">

                                    <span class="text-danger" id="userPasswordError"></span>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Assign Role</label>
                                    <select name="selectedRole" class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                        <option value="">--Select Role--</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" @foreach ($user->roles as $item) {{ $item->id === $role->id ? 'selected' : '' }} @endforeach>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger" id="selectRoleError"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Profile Picture">Profile Picture</label>
                                    <input type="file" name="profile_picture" class="form-control form-control-border"
                                        id="">

                                    <span class="text-danger" id="userProfError"></span>

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

            $('#updateUser').submit(el => {
                el.preventDefault();
                updateUser(el)

            })
        })

        function updateUser(el) {
            offError()
            sendReq()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('assign_roles.update', $user->id) }}`

            goPost(url, data)
                .then(res => {
                    location.href = `{{ route('assign_roles.index') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#userFirstNameError').html(err.message.first_name[0]);
            $('#userLastNameError').html(err.message.last_name[0]);
            $('#userPasswordError').html(err.message.password[0]);
            $('#selectRoleError').html(err.message.role[0]);
            $('#userProfError').html(err.message.profile_picture[0]);

        }

    </script>

@endpush
