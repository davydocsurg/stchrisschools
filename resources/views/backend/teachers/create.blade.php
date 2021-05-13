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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first name">First Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="teacherFirstName"
                                        name="first_name" placeholder="First Name">
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
                                        <input type="email" class="form-control form-control-border" id="teacherEmail"
                                            name="email" placeholder="Email">

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
                                            name="teacher_phone" placeholder="Phone Number">

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
                                        name="password" placeholder="Password">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Gender<code>*</code></label>
                                    <br>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" class="" id="maleTeacher" name="gender">
                                        <label for="maleTeacher">Male</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" class="" id="femaleTeacher" name="gender">
                                        <label for="femaleTeacher">Female</label>
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
                                            <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-border" name="current_address"
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
                                        <input type="text" class="form-control form-control-border" name="permanent_address"
                                            id="teacherPermanentAddress" placeholder="66 MT St.">
                                    </div>

                                    <span class="text-danger" id="perAddError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row mb-0 mt-3">
                            <div class="col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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

            $('#createTeacherForm').submit(el => {
                el.preventDefault();
                createTeacher(el)

            })
        })

        function createTeacher(el) {
            offError()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('teachers.store') }}`

            goPost(url, data)
                .then(res => {
                    console.log(data);
                    // location.href = `{{ url('/login') }}`
                })
                .catch(err => {
                    // spin('addcons')
                    // $('#firstNameError').html(err.message.first_name[0]);
                    // console.log(err.message.email[0]);
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
