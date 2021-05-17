@extends('layouts.master')

@section('title')
    Update Students
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
                    <h1 class="m-0">Update Students</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('students.index') }}" class="btn btn-outline-primary">
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
                        <h3 class="card-title">Update Student</h3>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" id="updateStudentForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first name">First Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="studentFirstName"
                                        name="first_name" placeholder="First Name" required
                                        value="{{ $student->user->first_name }}">
                                    <span class="text-danger" id="firstNameError"></span>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last name">Last Name<code>*</code></label>
                                    <input type="text" class="form-control form-control-border" id="studentLastName"
                                        name="last_name" placeholder="Last Name" required
                                        value="{{ $student->user->last_name }}">
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
                                        <input type="email" class="form-control form-control-border" id="studentEmail"
                                            name="email" placeholder="Email" required value="{{ $student->user->email }}">

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
                                        <input type="text" class="form-control form-control-border" id="studentPhone"
                                            name="student_phone" placeholder="Phone Number" required
                                            value="{{ $student->student_phone }}">

                                    </div>
                                    <span class="text-danger" id="studentPhoneError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Roll Number">Roll Number<code>*</code></label>

                                    <input type="number" class="form-control form-control-border" id="studentRollNumber"
                                        name="roll_number" placeholder="Roll Number" required
                                        value="{{ $student->roll_number }}">


                                    <span class="text-danger" id="rollNumberError"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Class">Assign Class</label>
                                    <select name="student_class_id" class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select Class--</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ $class->id === $student->student_class_id ? 'selected' : '' }}>
                                                {{ $class->class_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger" id="selectClassError"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="Student Parent">Student Parent</label>
                                    <select name="parent_id" class="form-control select2 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="">--Select Parent--</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}"
                                                {{ $parent->id === $student->parent_id ? 'selected' : '' }}>
                                                {{ $parent->user->first_name . ' ' . $parent->user->last_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <span class="text-danger" id="studentParentError"></span>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password<code>*</code></label>
                                    <input type="password" class="form-control form-control-border" id="studentPassword"
                                        name="password" placeholder="Password" required>
                                    <span class="text-danger" id="pwdError"></span>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password<code>*</code></label>

                                    <input type="password" class="form-control form-control-border" id="studentPasswordC"
                                        name="password_confirmation" placeholder="Re-type Password" required>
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
                                        <label for="maleStudent">Male</label>
                                        <input type="radio" class="" id="maleStudent" name="gender" value="male"
                                            {{ $student->gender == 'male' ? 'checked' : '' }}>
                                    </div>
                                    <div class="icheck-primary d-inline ml-3">
                                        <label for="femaleStudent">Female</label>
                                        <input type="radio" class="" id="femaleStudent" name="gender" value="female"
                                            {{ $student->gender == 'female' ? 'checked' : '' }}>
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
                                        <input type="date" class="form-control form-control-border" id="studentDOB"
                                            name="date_of_birth" placeholder="" required
                                            value="{{ $student->date_of_birth }}">

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
                                            id="parentCurrentAddress" placeholder="12 NY St." required
                                            value="{{ $student->current_address }}">

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
                                            id="parentPermanentAddress" placeholder="66 MT St." required
                                            value="{{ $student->permanent_address }}">
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

                                    <span class="text-danger" id="studentProfError"></span>

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
            let errors = []

            $('#updateStudentForm').submit(el => {
                el.preventDefault();
                updateStudent(el)

            })
        })

        function updateStudent(el) {
            offError()
            sendReq()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ route('students.update', $student->id) }}`

            goPost(url, data)
                .then(res => {
                    // console.log(data);
                    location.href = `{{ route('students.index') }}`
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
            $('#studentPhoneError').html(err.message.student_phone[0]);
            // $('#pwdError').html(err.message.password[0]);
            // $('#pwdCError').html(err.message.password_confirmation[0]);
            $('#genderError').html(err.message.gender[0]);
            $('#dobError').html(err.message.date_of_birth[0]);
            $('#currAddError').html(err.message.current_address[0]);
            $('#perAddError').html(err.message.permanent_address[0]);
            $('#rollNumberError').html(err.message.roll_number[0]);
            $('#studentParentError').html(err.message.parent_id[0]);
            $('#selectClassError').html(err.message.student_class_id[0]);
            // $('#studentProfError').html(err.message.profile_picture[0]);

        }

    </script>

@endpush
