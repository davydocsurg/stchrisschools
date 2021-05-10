<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Process User Signup
     * @return json
     */
    public function signUp(Request $request)
    {

        // dd($request->select_role);
        // Get validation rules
        $validate = $this->signUpRules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        // Create new user
        $user = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = strtolower($request->email);
        $user->select_role = $request->select_role;
        $user->password = Hash::make(strtolower($request->password));

        // sign up as a teacher
        if ($request->select_role == 'Teacher') {
            $this->signUpAsTeacher($request, $user);
        }

        // sign up as parent
        if ($request->select_role == 'Parent') {
            $this->signUpAsParent($request, $user);
        }

        // Try user save or catch error if any
        try {
            $user->save();

            // Attempt login
            // $this->fast_login($request);

            return response()->json([
                'success' => true,
                'message' => 'Signup Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /**
     * Signup Validation Rules
     * @return object The validator object
     */
    public function signUpRules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => 'required|email|unique:users', // email:rfc,dns should be used in production
            // 'phone' => 'required|numeric|digits_between:5,11|unique:users,phone',
            'password' => 'required|alpha_dash|min:8|max:30|confirmed',
            'select_role' => ['required', Rule::in(['Teacher', 'Parent'])],
        ]);
    }

    /**
     * Sign Up As A Teacher
     * @return json
     */
    public function signUpAsTeacher(Request $request, User $user)
    {
        // dd($request->all());
        $validate = $this->signUpAsTeacherRules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        // Create new user
        // $user = new User();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'password' => $request->password,
        ]);

        // $user->first_name = $request->first_name;
        // $user->last_name = $request->last_name;
        // $user->email = strtolower($request->email);
        // $user->password = Hash::make(strtolower($request->password));

        // create new teacher
        // $user->teacher()->gender = $request->gender;
        // $user->teacher()->teacher_phone = $request->teacher_phone;
        // $user->teacher()->date_of_birth = $request->date_of_birth;
        // $user->teacher()->current_address = $request->current_address;
        // $user->teacher()->permanent_address = $request->permanent_address;

        $user->teacher()->create([
            'gender' => $request->gender,
            'teacher_phone' => $request->teacher_phone,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ]);

        $user->assignRole('Teacher');

        // Try user save or catch error if any
        try {
            $user->save();
            // $user->teacher()->save();

            return response()->json([
                'success' => true,
                'message' => 'Teacher\'s Signup Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /**
     * Sign Up As A Teacher Rules
     * @return object The validator object
     */
    public function signUpAsTeacherRules(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => 'required|email|unique:users', // email:rfc,dns should be used in production
            // 'phone' => 'required|numeric|digits_between:5,11|unique:users,phone',
            'password' => 'required|alpha_dash|min:8|max:30|confirmed',
            'gender' => [
                'required', Rule::in(['male', 'female']),
            ],
            'teacher_phone' => 'required|numeric|digits_between:5,11|unique:teachers,teacher_phone',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|string|max:250',
            'permanent_address' => 'required|string|max:250',
        ]);
    }

    /**
     * Sign Up As A Parent
     * @return json
     */
    public function signUpAsParent(Request $request, User $user)
    {

        // dd($request->all());
        $validate = $this->signUpAsParentRules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        // Create new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'password' => $request->password,
        ]);

        // $user = new User();

        // $user->first_name = $request->first_name;
        // $user->last_name = $request->last_name;
        // $user->email = strtolower($request->email);
        // $user->password = Hash::make(strtolower($request->password));

        // create new parent
        // $user->parent()->gender = $request->gender;
        // $user->parent()->parent_phone = $request->parent_phone;
        // $user->parent()->date_of_birth = $request->date_of_birth;
        // $user->parent()->current_address = $request->current_address;
        // $user->parent()->permanent_address = $request->permanent_address;

        $user->parent()->create([
            'gender' => $request->gender,
            'parent_phone' => $request->parent_phone,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ]);

        $user->assignRole('Parent');

        // Try user save or catch error if any
        try {
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Parent\'s Signup Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /**
     * Sign Up As A Parent Rules
     * @return object The validator object
     */
    public function signUpAsParentRules(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => 'required|email|unique:users', // email:rfc,dns should be used in production
            // 'phone' => 'required|numeric|digits_between:5,11|unique:users,phone',
            'password' => 'required|alpha_dash|min:8|max:30|confirmed',
            'gender' => [
                'required', Rule::in(['male', 'female']),
            ],
            'parent_phone' => 'required|numeric|digits_between:5,11|unique:parents,parent_phone',
            // 'child_licence' => 'required|unique:parents',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|max:250',
            'permanent_address' => 'required|max:250',
        ]);
    }

    /**
     * Sign Up As A Student
     * @return json
     */
    public function signUpAsStudent(Request $request)
    {
        # code...
    }

    /**
     * Sign Up As A Student Rules
     * @return object The validator object
     */
    public function signUpAsStudentRules(Request $request)
    {
        return Validator::make($request->all(), [
            'gender' => [
                'required', Rule::in(['Male', 'Female']),
            ],
            'roll_number' => [
                'required',
                'numeric',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                }),
            ],
            'student_phone' => 'required|numeric|digits_between:5,11|unique:students,student_phone',
            // 'child_licence' => 'required|unique:parents',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|max:250',
            'permanent_address' => 'required|max:250',
        ]);
    }

    /**
     * User login without validation
     * @return void
     */
    public function fast_login(Request $request)
    {
        // Extract login credentials
        $credentials = $request->only(['email', 'password']);

        // Attempt Login and return status
        Auth::attempt($credentials, true);
    }
}
