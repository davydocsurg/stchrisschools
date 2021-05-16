@extends('layouts.master')

@section('title')
    Create Parents
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
                    <h1 class="m-0">Create Parents</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('parents.index') }}" class="btn btn-outline-primary">
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
                        <h3 class="card-title">Create Parent</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="createParentForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first name">First Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="parentFirstName"
                                        name="first_name" placeholder="First Name" required>
                                    <span class="text-danger" id="firstNameError"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last name">Last Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="parentLastName"
                                        name="last_name" placeholder="Last Name" required>
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
                                        <input type="email" class="form-control form-control-border" id="parentEmail"
                                            name="email" placeholder="Email" required>

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
                                        <input type="text" class="form-control form-control-border" id="parentPhone"
                                            name="parent_phone" placeholder="Phone Number" required>

                                    </div>
                                    <span class="text-danger" id="parentPhoneError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password<code>*</code></label>
                                    <input type="password" class="form-control form-control-border" id="teacherPassword"
                                        name="password" placeholder="Password" required>
                                    <span class="text-danger" id="pwdError"></span>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password<code>*</code></label>

                                    <input type="password" class="form-control form-control-border" id="teacherPasswordC"
                                        name="password_confirmation" placeholder="Re-type Password" required>
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
                                        <label for="maleParent">Male</label>
                                        <input type="radio" class="" id="maleParent" name="gender" value="male">
                                    </div>
                                    <div class="icheck-primary d-inline ml-3">
                                        <label for="femaleParent">Female</label>
                                        <input type="radio" class="" id="femaleParent" name="gender" value="female">
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
                                        <input type="date" class="form-control form-control-border" id="ParentDOB"
                                            name="date_of_birth" placeholder="" required>

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
                                            id="parentCurrentAddress" placeholder="12 NY St." required>

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
                                            id="parentPermanentAddress" placeholder="66 MT St." required>
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
                                    {{-- <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profile_picture"
                                                id="teacherProfilePics">
                                            <label class="custom-file-label" for="Profile Picture">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div> --}}
                                    <span class="text-danger" id="parentProfError"></span>

                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row mb-0 mt-3">
                            <div class="col-lg-6 offset-lg-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
            let errors = []

            $('#createParentForm').submit(el => {
                el.preventDefault();
                createParent(el)

            })
        })

        function createParent(el) {
            offError()
            sendReq()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('parents.store') }}`

            goPost(url, data)
                .then(res => {
                    // console.log(data);
                    location.href = `{{ route('parents.index') }}`
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
            $('#pwdError').html(err.message.password[0]);
            // $('#pwdCError').html(err.message.password_confirmation[0]);
            $('#genderError').html(err.message.gender[0]);
            $('#dobError').html(err.message.date_of_birth[0]);
            $('#currAddError').html(err.message.current_address[0]);
            $('#perAddError').html(err.message.permanent_address[0]);
            // $('#parentProfError').html(err.message.profile_picture[0]);

        }

    </script>

@endpush
