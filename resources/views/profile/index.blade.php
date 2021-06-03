@extends('layouts.master')

@section('title')
    Manage Your Profile
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
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Your Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ url('storage/users/profile/' . Auth::user()->profile_picture) }}"
                                alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}">
                        </div>

                        <h3 class="profile-username text-center">
                            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h3>

                        @role('Admin')
                        <p class="text-success font-weight-bold text-center">{{ Auth::user()->roles[0]->name ?? '' }}</p>
                        @endrole

                        @role('Teacher')
                        <p class="text-info font-weight-bold text-center">{{ Auth::user()->roles[0]->name ?? '' }}</p>
                        @endrole

                        @role('Parent')
                        <p class="text-primary font-weight-bold text-center">{{ Auth::user()->roles[0]->name ?? '' }}</p>
                        @endrole

                        @role('Student')
                        <p class="text-muted font-weight-bold text-center">{{ Auth::user()->roles[0]->name ?? '' }}</p>
                        @endrole

                        <p class="text-muted font-weight-bold text-center">{{ Auth::user()->email }}</p>

                        @role('Teacher')
                        <p class="text-muted text-center">{{ $teacher->teacher_phone }}</p>
                        @endrole

                        @role('Parent')
                        <p class="text-muted text-center">{{ $parent->parent_phone }}</p>
                        @endrole

                        @role('Student')
                        <p class="text-muted text-center">{{ $student->student_phone }}</p>
                        @endrole

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @role('Student')
                        <strong><i class="fas fa-book mr-1"></i> Gender</strong>
                        <br>
                        <b class="text-muted">
                            {{ $student->gender }}
                        </b>
                        @endrole

                        @role('Teacher')
                        <strong><i class="fas fa-book mr-1"></i> Gender</strong>
                        <br>
                        <b class="text-muted">
                            {{ $teacher->gender }}
                        </b>
                        @endrole

                        @role('Parent')
                        <strong><i class="fas fa-book mr-1"></i> Gender</strong>
                        <br>
                        <b class="text-muted">
                            {{ $parent->gender }}
                        </b>
                        @endrole

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                            neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile
                                    Settings</a></li>

                            <li class="nav-item"><a class="nav-link " href="#change-password" data-toggle="tab">Change
                                    Password</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="change-password">
                                <!-- Password -->
                                <div class="post">
                                    <form method="post" action="{{ route('password.change') }}" id="updatePasswordForm">
                                        @csrf

                                        {{-- @method('PUT') --}}
                                        <label for="New Password">Current Password</label>

                                        <div class="input-group">
                                            <input type="password" required name="current_password" id="currentPassword"
                                                class="form-control" placeholder="Enter Current Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text btn btn-outline-info"
                                                    style="cursor: pointer !important" id="viewPassword"
                                                    onclick="revealPassword()">
                                                    <span class="fas fa-eye"></span>
                                                </div>
                                                {{-- hide password --}}
                                                <div class="input-group-text btn btn-outline-warning"
                                                    style="cursor: pointer !important" id="hidePassword"
                                                    onclick="hidePassword()">
                                                    <span class="far fa-eye-slash"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if (session('current_password_msg'))
                                            <span class="text-danger">{{ session('current_password_msg') }}</span>
                                        @endif
                                        <br class="mb-3">

                                        <label for="New Password"> New Password</label>

                                        <div class="input-group">
                                            <input type="password" required name="new_password" id="newPassword"
                                                class="form-control" placeholder="Enter New Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text btn btn-outline-info"
                                                    style="cursor: pointer !important" id="viewPassword1"
                                                    onclick="revealPassword1()">
                                                    <span class="fas fa-eye"></span>
                                                </div>
                                                {{-- hide password --}}
                                                <div class="input-group-text btn btn-outline-warning"
                                                    style="cursor: pointer !important" id="hidePassword1"
                                                    onclick="hidePassword1()">
                                                    <span class="far fa-eye-slash"></span>
                                                </div>
                                            </div>
                                        </div>

                                        @if (session('new_password_msg'))
                                            <span class="text-danger">{{ session('new_password_msg') }}</span>
                                        @endif
                                        <br class="mb-3">

                                        <label for="New Password">Confirm New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" required name="new_password_confirmation"
                                                id="confirmNewPassword" class="form-control"
                                                placeholder="Confirm New Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text btn btn-outline-info"
                                                    style="cursor: pointer !important" id="viewPassword2"
                                                    onclick="revealPassword2()">
                                                    <span class="fas fa-eye"></span>
                                                </div>
                                                {{-- hide password --}}
                                                <div class="input-group-text btn btn-outline-warning"
                                                    style="cursor: pointer !important" id="hidePassword2"
                                                    onclick="hidePassword2()">
                                                    <span class="far fa-eye-slash"></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10 col-md-10 col-lg-10 text-center">
                                                <button type="submit" class="btn btn-outline-primary">
                                                    Save <span class="spinner-border spinner-border-sm mb-1" role="status"
                                                        aria-hidden="true" style="display: none"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.password -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" id="updateProfileForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="First Name" class="col-sm-2 col-form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputFirstName" name="first_name"
                                                value="{{ Auth::user()->first_name }}" required>
                                        </div>
                                        <span class="text-danger" id="firstNameError"></span>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Last Name" class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputLastName" name="last_name"
                                                value="{{ Auth::user()->last_name }}" required>
                                        </div>
                                        <span class="text-danger" id="lastNameError"></span>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="inputEmail"
                                                value="{{ Auth::user()->email }}" placeholder="Email" required>
                                        </div>
                                        <span class="text-danger" id="emailError"></span>
                                    </div>

                                    @role('Teacher')
                                    <div class="form-group row">
                                        <label for="inputTeacherPhone" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="teacher_phone" class="form-control"
                                                id="inputTeacherPhone" value="{{ $teacher->teacher_phone }}"
                                                placeholder="87766477">
                                        </div>
                                        <span class="text-danger" id="teacherPhoneError"></span>
                                    </div>
                                    @endrole

                                    @role('Parent')
                                    <div class="form-group row">
                                        <label for="inputParentPhone" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="parent_phone" class="form-control"
                                                id="inputParentPhone" value="{{ $parent->parent_phone }}"
                                                placeholder="87766477">
                                        </div>
                                        <span class="text-danger" id="parentPhoneError"></span>
                                    </div>
                                    @endrole

                                    @role('Student')
                                    <div class="form-group row">
                                        <label for="inputStudentPhone" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="student_phone" class="form-control"
                                                id="inputStudentPhone" value="{{ $student->student_phone }}"
                                                placeholder="87766477">
                                        </div>
                                        <span class="text-danger" id="studentPhoneError"></span>
                                    </div>
                                    @endrole

                                    <div class="form-group row">
                                        <label for="inputProfilePicture" class="col-sm-2 col-form-label">Profile
                                            Picture</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="profile_picture" class="form-control"
                                                id="inputProfilePicture" value="" placeholder="">
                                        </div>
                                        <span class="text-danger" id="profilePictureError"></span>
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-outline-primary">
                                                Save <span class="spinner-border spinner-border-sm mb-1" role="status"
                                                    aria-hidden="true" style="display: none"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@push('scripts')
    <script>
        $('#hidePassword').hide()
        $('#hidePassword1').hide()
        $('#hidePassword2').hide()

        $(document).ready(() => {

            $('#updateProfileForm').submit(el => {
                el.preventDefault();
                updateProfile(el)

            })

            $('#updatePasswordForm').submit(el => {
                sendReq()

                // el.preventDefault();
                // updatePassword(el)

            })
        })

        /********* show password ********/
        function revealPassword() {
            // el.preventDefault()
            $('#currentPassword').attr('type', 'text')
            $('#viewPassword').hide(1000)
            $('#hidePassword').show(1000)
        }

        function revealPassword1() {
            $('#newPassword').attr('type', 'text')
            $('#viewPassword1').hide(1000)
            $('#hidePassword1').show(1000)
        }

        function revealPassword2() {
            $('#confirmNewPassword').attr('type', 'text')
            $('#viewPassword2').hide(1000)
            $('#hidePassword2').show(1000)
        }

        /********* hide password ********/

        function hidePassword() {
            // el.preventDefault()
            $('#currentPassword').attr('type', 'password')
            $('#hidePassword').hide(1000)
            $('#viewPassword').show(1000)
        }

        function hidePassword1() {
            $('#newPassword').attr('type', 'password')
            $('#hidePassword1').hide(1000)
            $('#viewPassword1').show(1000)
        }

        function hidePassword2() {
            $('#confirmNewPassword').attr('type', 'password')
            $('#hidePassword2').hide(1000)
            $('#viewPassword2').show(1000)
        }

        function updateProfile(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('profile.update') }}`

            goPost(url, data)
                .then(res => {
                    location.href = `{{ route('profile') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function updatePassword(el) {
            offError()
            sendReq()

            let data = new FormData(el.target)
            let url = `{{ route('password.change') }}`

            goPost(url, data)
                .then(res => {
                    location.href = `{{ route('profile') }}`
                })
                .catch(err => {

                    handleErr(err)
                    errorMsg(err)

                })
        }

        function errorMsg(err) {
            $('#firstNameError').html(err.message.first_name[0]);
            $('#lastNameError').html(err.message.last_name[0]);
            $('#emailError').html(err.message.email[0]);
            $('#parentPhoneError').html(err.message.parent_phone[0]);
            $('#studentPhoneError').html(err.message.student_phone[0]);
            $('#teacherPhoneError').html(err.message.teacher_phone[0]);
            $('#pwdError').html(err.message.password[0]);
            $('#genderError').html(err.message.gender[0]);
            $('#dobError').html(err.message.date_of_birth[0]);
            $('#currAddError').html(err.message.current_address[0]);
            $('#perAddError').html(err.message.permanent_address[0]);
            // $('#parentProfError').html(err.message.profile_picture[0]);
            // location.reload()

        }

    </script>

@endpush
