@extends('layouts.master')

@section('title')
    Create Teachers
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
                    <h1 class="m-0">Create Teachers</h1>
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
                        <h3 class="card-title">Create Teacher</h3>
                    </div>

                    {{-- <div class="card-tools col-md-6 col-sm-12">
                        <div class="input-group input-group-sm  float-right" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="createTeacherForm">
                        @csrf
                        <div id="teachers-container">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first name">First Name<code>*</code></label>
                                            <input type="text" class="form-control form-control-border"
                                                id="teacherFirstName" name="first_name" placeholder="First Name">
                                            <span class="text-danger" id="firstNameError"></span>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last name">Last Name<code>*</code></label>
                                            <input type="text" class="form-control form-control-border" id="teacherLastName"
                                                name="last_name" placeholder="Last Name">
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
                                                <input type="email" class="form-control form-control-border"
                                                    id="teacherEmail" name="email" placeholder="Email">

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
                                                <input type="text" class="form-control form-control-border"
                                                    id="teacherPhone" name="teacher_phone" placeholder="Phone Number">

                                            </div>
                                            <span class="text-danger" id="teacherPhoneError"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password<code>*</code></label>
                                            <input type="password" class="form-control form-control-border"
                                                id="teacherPassword" name="password" placeholder="Password">
                                            <span class="text-danger" id="pwdError"></span>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Gender<code>*</code></label>
                                            <br>
                                            <div class="icheck-primary d-inline">
                                                <label for="maleTeacher">Male</label>
                                                <input type="radio" class="" id="maleTeacher" name="gender" value="male">
                                            </div>
                                            <div class="icheck-primary d-inline ml-3">
                                                <label for="femaleTeacher">Female</label>
                                                <input type="radio" class="" id="femaleTeacher" name="gender"
                                                    value="female">
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
                                                    name="date_of_birth" placeholder="">

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
                                                    <span class="input-group-text"><i
                                                            class="fas fa-address-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control form-control-border"
                                                    name="current_address" id="teacherCurrentAddress"
                                                    placeholder="12 NY St.">

                                            </div>
                                            <span class="text-danger" id="currAddError"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="permanent address">Permanent Address<code>*</code></label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-address-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control form-control-border"
                                                    name="permanent_address" id="teacherPermanentAddress"
                                                    placeholder="66 MT St.">
                                            </div>

                                            <span class="text-danger" id="perAddError"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Profile Picture">Profile Picture</label>
                                            <input type="file" name="profile_picture"
                                                class="form-control form-control-border" id="">

                                            <span class="text-danger" id="teacherProfError"></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="teachers-container">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first name">First Name<code>*</code></label>
                                            <input type="text" class="form-control form-control-border"
                                                id="teacherFirstName" name="first_name[]" placeholder="First Name">
                                            <span class="text-danger" id="firstNameError"></span>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last name">Last Name<code>*</code></label>
                                            <input type="text" class="form-control form-control-border" id="teacherLastName"
                                                name="last_name[]" placeholder="Last Name">
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
                                                <input type="email" class="form-control form-control-border"
                                                    id="teacherEmail" name="email[]" placeholder="Email">

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
                                                <input type="text" class="form-control form-control-border"
                                                    id="teacherPhone" name="teacher_phone[]" placeholder="Phone Number">

                                            </div>
                                            <span class="text-danger" id="teacherPhoneError"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password<code>*</code></label>
                                            <input type="password" class="form-control form-control-border"
                                                id="teacherPassword" name="password[]" placeholder="Password">
                                            <span class="text-danger" id="pwdError"></span>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password<code>*</code></label>

                                            <input type="password" class="form-control form-control-border"
                                                id="teacherPasswordC" name="password_confirmation[]"
                                                placeholder="Re-type Password">
                                            <span class="text-danger" id="pwdCError"></span>


                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Gender<code>*</code></label>
                                            <br>
                                            <div class="icheck-primary d-inline">
                                                <label for="maleTeacher">Male</label>
                                                <input type="radio" class="" id="maleTeacher" name="gender[]" value="male">
                                            </div>
                                            <div class="icheck-primary d-inline ml-3">
                                                <label for="femaleTeacher">Female</label>
                                                <input type="radio" class="" id="femaleTeacher" name="gender[]"
                                                    value="female">
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
                                                    name="date_of_birth[]" placeholder="">

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
                                                    <span class="input-group-text"><i
                                                            class="fas fa-address-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control form-control-border"
                                                    name="current_address[]" id="teacherCurrentAddress"
                                                    placeholder="12 NY St.">

                                            </div>
                                            <span class="text-danger" id="currAddError"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="permanent address">Permanent Address<code>*</code></label>

                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-address-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control form-control-border"
                                                    name="permanent_address[]" id="teacherPermanentAddress"
                                                    placeholder="66 MT St.">
                                            </div>

                                            <span class="text-danger" id="perAddError"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Profile Picture">Profile Picture</label>
                                            <input type="file" name="profile_picture[]"
                                                class="form-control form-control-border" id="">

                                            <span class="text-danger" id="teacherProfError"></span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group text-center row mb-0 mt-3">
                            <div class="col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                    <span class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"
                                        style="display: none"></span>
                                </button>
                            </div>
                        </div>

                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <div class="btn btn-md btn-outline-primary" onclick="addTeacherForm()">
                                    <i class="fas fa-plus"></i> Add Teacher
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div id="teacher-repeater" class="d-none">
        <div class="">
            <div class="row mt-5">
                <div class="col-12">
                    <i class="far fa-times-circle text-danger float-right"
                        style="cursor: pointer; font-size: 1.5rem !important;" onclick="removeTeacherForm(this)">
                    </i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first name">First Name<code>*</code></label>
                        <input type="text" class="form-control form-control-border" id="teacherFirstName"
                            name="first_name[]" placeholder="First Name">
                        <span class="text-danger" id="firstNameError"></span>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last name">Last Name<code>*</code></label>
                        <input type="text" class="form-control form-control-border" id="teacherLastName" name="last_name[]"
                            placeholder="Last Name">
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
                            <input type="email" class="form-control form-control-border" id="teacherEmail" name="email[]"
                                placeholder="Email">

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
                                name="teacher_phone[]" placeholder="Phone Number">

                        </div>
                        <span class="text-danger" id="teacherPhoneError"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password<code>*</code></label>
                        <input type="password" class="form-control form-control-border" id="teacherPassword"
                            name="password[]" placeholder="Password">
                        <span class="text-danger" id="pwdError"></span>

                    </div>
                </div>

                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password<code>*</code></label>

                        <input type="password" class="form-control form-control-border" id="teacherPasswordC"
                            name="password_confirmation[]" placeholder="Re-type Password">
                        <span class="text-danger" id="pwdCError"></span>


                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Gender<code>*</code></label>
                        <br>
                        <div class="icheck-primary d-inline">
                            <label for="maleTeacher">Male</label>
                            <input type="radio" class="" id="maleTeacher" name="gender[]" value="male">
                        </div>
                        <div class="icheck-primary d-inline ml-3">
                            <label for="femaleTeacher">Female</label>
                            <input type="radio" class="" id="femaleTeacher" name="gender[]" value="female">
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
                                name="date_of_birth[]" placeholder="">

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
                            <input type="text" class="form-control form-control-border" name="current_address[]"
                                id="teacherCurrentAddress" placeholder="12 NY St.">

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
                            <input type="text" class="form-control form-control-border" name="permanent_address[]"
                                id="teacherPermanentAddress" placeholder="66 MT St.">
                        </div>

                        <span class="text-danger" id="perAddError"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Profile Picture">Profile Picture</label>
                        <input type="file" name="profile_picture[]" class="form-control form-control-border" id="">

                        <span class="text-danger" id="teacherProfError"></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {

            $('#createTeacherForm').submit(el => {
                el.preventDefault();
                createTeacher(el)

            })
        })

        function createTeacher(el) {
            offError()
            sendReq()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('teachers.store') }}`

            goPost(url, data)
                .then(res => {
                    location.href = `{{ route('teachers.index') }}`
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
            $('#teacherPhoneError').html(err.message.teacher_phone[0]);
            $('#pwdError').html(err.message.password[0]);
            // $('#pwdCError').html(err.message.password_confirmation[0]);
            $('#genderError').html(err.message.gender[0]);
            $('#dobError').html(err.message.date_of_birth[0]);
            $('#currAddError').html(err.message.current_address[0]);
            $('#perAddError').html(err.message.permanent_address[0]);
            // $('#teacherProfError').html(err.message.profile_picture[0]);

        }

        function addTeacherForm() {

            form = $('#teacher-repeater').html()
            $('#teachers-container').append(form)
        }

        // remove form
        function removeTeacherForm(el) {
            $(el).parent().parent().parent().remove()

        }

    </script>

@endpush
