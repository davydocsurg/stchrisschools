@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-center mb-3">
            Register As A:
        </h3>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <div class="card">
                    <div class="card-body">
                        {{-- <button class="btn btn-outline-dark btn-md" id="studentBtn">
                            Teacher <i class="fas fa-chalkboard-teacher"></i>
                        </button> --}}
                        <button class="btn btn-outline-dark btn-md" id="parentBtn">
                            Parent <i class="fas fa-user-tie"></i>
                        </button>
                        <button class="btn btn-outline-dark btn-md" id="studentBtn">
                            Student <i class="fas fa-user-graduate"></i>
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-8">


                {{-- parent's only --}}
                <div class="card" id="parentRegistration">
                    <div class="card-header text-center">{{ __('Parents\' Registeration') }}</div>

                    <div class="card-body">
                        <form method="POST" id="parentRegisterForm">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="first_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="parent_phone" class="col-md-4 col-form-label text-md-right">Phone
                                    Number</label>

                                <div class="col-md-6">
                                    <input type="text" name="parent_phone" id="parentPhone" class="form-control"
                                        autocomplete="parent_phone">
                                </div>
                                @error('parent_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">Date Of
                                    Birth</label>

                                <div class="col-md-6">
                                    <input type="date" name="date_of_birth" id="parentDateOfBirth" class="form-control"
                                        autocomplete="date_of_birth">
                                </div>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="current_address" class="col-md-4 col-form-label text-md-right">Current
                                    Address</label>

                                <div class="col-md-6">
                                    <input type="text" name="current_address" id="parentCurrentAddress" class="form-control"
                                        autocomplete="current_address">
                                </div>
                                @error('current_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="permanent_address" class="col-md-4 col-form-label text-md-right">
                                    Permanent Address</label>

                                <div class="col-md-6">
                                    <input type="text" name="permanent_address" id="parentPermanentAddress"
                                        class="form-control" autocomplete="permanent_address">
                                </div>
                                @error('permanent_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="">
                                            <input name="gender" class="mr-2 leading-tight" type="radio" value="male"
                                                id="maleStudent">
                                            <span class="text-sm">Male</span>
                                        </label>
                                        <label class="ml-4 block font-bold">
                                            <input name="gender" class="mr-2 leading-tight" type="radio" value="female"
                                                id="femaleStudent">
                                            <span class="text-sm">Female</span>
                                        </label>
                                    </div>
                                    @error('gender')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- parent's only --}}

                {{-- students only --}}
                <div class="card" id="studentRegistration">
                    <div class="card-header text-center">{{ __('Students\' Registeration') }}</div>

                    <div class="card-body">
                        <form method="POST" id="studentRegisterForm">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="first_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="roll_number" class="col-md-4 col-form-label text-md-right">Roll
                                    Number</label>

                                <div class="col-md-6">
                                    <input type="number" name="roll_number" id="roleNumber" class="form-control"
                                        autocomplete="roll_number">
                                </div>
                                @error('roll_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="form-group row">
                                <label for="student_phone" class="col-md-4 col-form-label text-md-right">Phone
                                    Number</label>

                                <div class="col-md-6">
                                    <input type="text" name="student_phone" id="studentPhone" class="form-control"
                                        autocomplete="student_phone">
                                </div>
                                @error('student_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">Date Of
                                    Birth</label>

                                <div class="col-md-6">
                                    <input type="date" name="date_of_birth" id="studentDateOfBirth" class="form-control"
                                        autocomplete="date_of_birth">
                                </div>
                                @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="current_address" class="col-md-4 col-form-label text-md-right">Current
                                    Address</label>

                                <div class="col-md-6">
                                    <input type="text" name="current_address" id="studentCurrentAddress"
                                        class="form-control" autocomplete="current_address">
                                </div>
                                @error('current_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="permanent_address" class="col-md-4 col-form-label text-md-right">
                                    Permanent Address</label>

                                <div class="col-md-6">
                                    <input type="text" name="permanent_address" id="studentPermanentAddress"
                                        class="form-control" autocomplete="permanent_address">
                                </div>
                                @error('permanent_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="gender"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="">
                                            <input name="gender" class="mr-2 leading-tight" type="radio" value="male"
                                                id="maleStudent">
                                            <span class="text-sm">Male</span>
                                        </label>
                                        <label class="ml-4 block font-bold">
                                            <input name="gender" class="mr-2 leading-tight" type="radio" value="female"
                                                id="femaleStudent">
                                            <span class="text-sm">Female</span>
                                        </label>
                                    </div>
                                    @error('gender')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- end of students --}}
            </div>

        </div>
    </div>
@endsection
{{-- // import $ from "jquery";
    // window.jQuery = $;
		// document.addEventListener("DOMContentLoaded", function(event) {
    // window.$ = $; --}}
@push('scripts')
    <script>
        $(document).ready(() => {
            // hide all forms
            hideAllRegistrations()

            //
            $('#parentBtn').click(function() {
                hideStudentRegistration()
                showParentRegistration()
            })

            //
            $('#studentBtn').click(function() {
                hideParentRegistration()
                showStudentRegistration()
            })

            //
            $('#studentRegisterForm').submit(el => {
                el.preventDefault();
                registerStudent(el)

            })

            //
            $('#parentRegisterForm').submit(el => {
                el.preventDefault();
                registerParent(el)

            })
        })

        // show students' fields
        function showStudentRegistration() {
            $('#studentRegistration').show(1000);
            //
            $('#studentPhone').attr('required', '');
            $('#studentPhone').attr('data-error', 'This field is required.');
            //
            // $('#rollNumber').attr('required', '');
            // $('#rollNumber').attr('data-error', 'This field is required.');
            //
            $('#studentDateOfBirth').attr('required', '');
            $('#studentDateOfBirth').attr('data-error', 'This field is required.');
            //
            $('#studentCurrentAddress').attr('required', '');
            $('#studentCurrentAddress').attr('data-error', 'This field is required.');
            //
            $('#studentPermanentAddress').attr('required', '');
            $('#studentPermanentAddress').attr('data-error', 'This field is required.');
        }

        // show parents fields
        function showParentRegistration() {
            $('#parentRegistration').show(1000);
            $('#parentPhone').attr('required', '');
            $('#parentPhone').attr('data-error', 'This field is required.');
            //
            $('#parentDateOfBirth').attr('required', '');
            $('#parentDateOfBirth').attr('data-error', 'This field is required.');
            //
            $('#parentCurrentAddress').attr('required', '');
            $('#parentCurrentAddress').attr('data-error', 'This field is required.');
            //
            $('#parentPermanentAddress').attr('required', '');
            $('#parentPermanentAddress').attr('data-error', 'This field is required.');
        }

        // hide students' fields
        function hideStudentRegistration() {
            $('#studentRegistration').hide(1000);
            //
            $('#studentPhone').removeAttr('required');
            $('#studentPhone').removeAttr('data-error');
            //
            // $('#rollNumber').removeAttr('required');
            // $('#rollNumber').removeAttr('data-error');
            //
            $('#studentDateOfBirth').removeAttr('required', '');
            $('#studentDateOfBirth').removeAttr('data-error');
            //
            $('#studentCurrentAddress').removeAttr('required', '');
            $('#studentCurrentAddress').removeAttr('data-error');
            //
            $('#studentPermanentAddress').removeAttr('required', '');
            $('#studentPermanentAddress').removeAttr('data-error');
        }

        // hide parent fields
        function hideParentRegistration() {
            $('#parentRegistration').hide(1000);
            $('#parentPhone').removeAttr('required');
            $('#parentPhone').removeAttr('data-error');
            //
            $('#parentDateOfBirth').removeAttr('required', '');
            $('#parentDateOfBirth').removeAttr('data-error');
            //
            $('#parentCurrentAddress').removeAttr('required', '');
            $('#parentCurrentAddress').removeAttr('data-error');
            //
            $('#parentPermanentAddress').removeAttr('required', '');
            $('#parentPermanentAddress').removeAttr('data-error');
        }

        // hide all fields
        function hideAllRegistrations() {
            hideParentRegistration()
            hideStudentRegistration()
        }

        // actions
        function registerStudent(el) {

            offError()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ url('student_signup') }}`

            goPost(url, data)
                .then(res => {
                    console.log(data);
                    // spin('addcons')
                    // location.reload()
                })
                .catch(err => {
                    // spin('addcons')
                    handleFormRes(err)
                })
        }

        function registerParent(el) {
            offError()
            // spin('addcons')

            let data = new FormData(el.target)
            let url = `{{ url('parent_signup') }}`

            goPost(url, data)
                .then(res => {
                    console.log(data);
                    // spin('addcons')
                    location.reload()
                })
                .catch(err => {
                    spin('addcons')
                    handleFormRes(err)
                })
        }

    </script>
@endpush
