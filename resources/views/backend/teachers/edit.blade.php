@extends('layouts.master')

@section('title')
    Edit Teacher
@endsection

<style>
    @media screen and (max-width:360px) {
        .card-tools {
            margin-top: 1.2rem !important;
        }
    }

    .fa-spin {
        -webkit-animation: fa-spin 2s linear infinite;
        animation: fa-spin 2s linear infinite;
        animation-name: fa-spin;
        animation-duration: 2s;
        animation-timing-function: linear;
        animation-delay: 0s;
        animation-iteration-count: infinite;
        animation-direction: normal;
        animation-fill-mode: none;
        animation-play-state: running;
    }

</style>

@section('page_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Teacher - {{ $teacher->user->first_name . ' ' . $teacher->user->last_name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('teachers.index') }}" class="btn btn-outline-primary">
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
                        <h3 class="card-title">Edit Teacher</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="image text-center mb-3">
                        <img src="{{ url('storage/users/profile/' . $teacher->user->profile_picture) }}"
                            class="img-circle elevation-2"
                            alt="{{ $teacher->user->first_name . ' ' . $teacher->user->last_name }}">
                    </div>
                    <form method="post" id="updateTeacherForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first name">First Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="teacherFirstName"
                                        name="first_name" placeholder="First Name"
                                        value="{{ $teacher->user->first_name }}">
                                    <span class="text-danger" id="firstNameError"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last name">Last Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="teacherLastName"
                                        name="last_name" placeholder="Last Name" value="{{ $teacher->user->last_name }}">
                                    <span class="text-danger" id="lastNameError"></span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email<code>*</code></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control form-control-border" id="teacherEmail"
                                            name="email" placeholder="Email" value="{{ $teacher->user->email }}">

                                    </div>
                                    <span class="text-danger" id="emailError"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number<code>*</code></label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-border" id="teacherPhone"
                                            name="teacher_phone" placeholder="Phone Number"
                                            value="{{ $teacher->teacher_phone }}">

                                    </div>
                                    <span class="text-danger" id="teacherPhoneError"></span>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password<code>*</code></label>
                                    <input type="password" class="form-control form-control-border" id="teacherPassword"
                                        name="password" placeholder="Password" value="">
                                    <span class="text-danger" id="pwdError"></span>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password<code>*</code></label>

                                    <input type="password" class="form-control form-control-border" id="teacherPasswordC"
                                        name="password_confirmation" placeholder="Re-type Password">
                                    <span class="text-danger" id="pwdCError"></span>


                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Gender<code>*</code></label>
                                    <br>
                                    <div class="icheck-primary d-inline">
                                        <label for="maleTeacher">Male</label>
                                        <input type="radio" class="" id="maleTeacher" name="gender" value="male"
                                            {{ $teacher->gender == 'male' ? 'checked' : '' }}>
                                    </div>
                                    <div class="icheck-primary d-inline ml-3">
                                        <label for="femaleTeacher">Female</label>
                                        <input type="radio" class="" id="femaleTeacher" name="gender" value="female"
                                            {{ $teacher->gender == 'female' ? 'checked' : '' }}>
                                    </div>
                                    <br>
                                    <span class="text-danger" id="genderError"></span>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">Date Of Birth<code>*</code></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control form-control-border" id="teacherDOB"
                                            name="date_of_birth" placeholder="" value="{{ $teacher->date_of_birth }}">

                                    </div>
                                    <span class="text-danger" id="dobError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="current address">Current Address<code>*</code></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-border" name="current_address"
                                            id="teacherCurrentAddress" placeholder="12 NY St."
                                            value="{{ $teacher->current_address }}">

                                    </div>
                                    <span class="text-danger" id="currAddError"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="permanent address">Permanent Address<code>*</code></label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-border" name="permanent_address"
                                            id="teacherPermanentAddress" placeholder="66 MT St."
                                            value="{{ $teacher->permanent_address }}">
                                    </div>

                                    <span class="text-danger" id="perAddError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Profile Picture">Profile Picture</label>
                                    <input type="file" name="profile_picture" class="form-control form-control-border"
                                        id="">

                                    <span class="text-danger" id="teacherProfError"></span>

                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row mb-0 mt-3">
                            <div class="col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
            let errors = []

            $('#updateTeacherForm').submit(el => {
                el.preventDefault();
                updateTeacher(el)

            })
        })

        function updateTeacher(el) {
            offError()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('teachers.update', $teacher->id) }}`

            goPost(url, data)
                .then(res => {
                    // console.log(data);
                    location.href = `{{ route('teachers.index') }}`
                })
                .catch(err => {
                    // spin('addcons')
                    // console.log(err);
                    errorMsg(err)
                    this.errors = err.message;
                    // handleFormRes(err)
                })
        }

        function errorMsg(err) {
            $('#firstNameError').html(err.message.first_name[0]);
            $('#lastNameError').html(err.message.last_name[0]);
            $('#emailError').html(err.message.email[0]);
            $('#teacherPhoneError').html(err.message.teacher_phone[0]);
            $('#pwdError').html(err.message.password[0]);
            // $('#pwdCError').html(err.message.password_confirmation[0]);
            $('#genderError').html(err.message.gender[0]);
            $('#dobError').html(err.message.date_of_birth[0]);
            $('#currAddError').html(err.message.current_address[0]);
            $('#perAddError').html(err.message.permanent_address[0]);

        }

    </script>

@endpush
