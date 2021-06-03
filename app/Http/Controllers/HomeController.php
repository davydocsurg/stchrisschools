<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Parents;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {

            $parents = Parents::latest()->get();
            $teachers = Teacher::latest()->get();
            $students = Student::latest()->get();
            $roles = Role::latest()->get();

            return view('dashboard', compact('parents', 'teachers', 'students', 'roles'));

        } elseif ($user->hasRole('Teacher')) {

            $teacher = Teacher::with(['user', 'subjects', 'classes', 'students'])->withCount('subjects', 'classes')->findOrFail($user->teacher->id);
            $lessons = Lesson::with(['teacher'])->latest()->get();

            return view('dashboard', compact('teacher', 'lessons'));

        } elseif ($user->hasRole('Parent')) {

            $parents = Parents::with(['children'])->withCount('children')->findOrFail($user->parent->id);

            return view('dashboard', compact('parents'));

        } elseif ($user->hasRole('Student')) {

            $student = Student::with(['user', 'parent', 'class', 'attendances'])->findOrFail($user->student->id);

            return view('dashboard', compact('student'));

        } else {
            return 'NO ROLE ASSIGNED YET!';
        }
    }

    public function profile(Teacher $teacher, Parents $parent, Student $student)
    {
        if (Auth::user()->hasRole('Teacher')) {
            $teacher = Auth::user()->teacher;

        }
        if (Auth::user()->hasRole('Parent')) {
            $parent = Auth::user()->parent;

        }
        if (Auth::user()->hasRole('Student')) {
            $student = Auth::user()->student;

        }
        return view('profile.index', compact('parent', 'teacher', 'student'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        // Get validation rules
        $validate = $this->edit_profile_rules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            $old = $user->profile_picture;
            // validate photo
            $validateph = $this->profile_pics_rules($request);

            // Run validation
            if ($validateph->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateph->errors(),
                    'status' => 400,
                ]);
            }
            // Attempt Photo Upload
            $upload = Storage::put('/public/users/profile', $request->profile_picture);
            $photo = basename($upload);

            $user->profile_picture = $photo;
            $old != 'avatar.png' ? Storage::delete('/public/users/profile/' . $old) : null;

            if (!$upload) {
                Storage::delete('/public/users/profile' . $photo);

                return response()->json([
                    'success' => false,
                    'message' => 'Oops! Something went wrong. Try Again!',
                    'status' => 400,
                ]);
            }

        } else {
            $photo = $user->profile_picture;
        }

        if ($request->teacher_phone) {
            $request->validate([
                'teacher_phone' => 'numeric|digits_between:5,11|unique:teachers,teacher_phone,' . auth()->id(),

            ]);

            $user->teacher()->update([
                'teacher_phone' => $request->teacher_phone,
            ]);
        }

        if ($request->parent_phone) {
            $request->validate([
                'parent_phone' => 'numeric|digits_between:5,11|unique:parents,parent_phone,' . auth()->id(),

            ]);
            $user->parent()->update([
                'parent_phone' => $request->parent_phone,
            ]);
        }

        if ($request->student_phone) {
            $request->validate([
                'student_phone' => 'numeric|digits_between:5,11|unique:students,student_phone,' . auth()->id(),
            ]);
            $user->student()->update([
                'student_phone' => $request->student_phone,
            ]);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'profile_picture' => $photo,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function edit_profile_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [

            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            // 'password' => 'required|string|min:8',
            //   ',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function profile_pics_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'profile_picture' => 'required|file|max:5120',
        ]);
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            session()->flash('current-password-mismatch', 'Your current password does not matches with the password you provided! Please try again.');
            return back()->with([
                'current_password_msg' => 'Your current password does not matches with the password you provided! Please try again.',
            ]);
            // return back();
        }
        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            session()->flash('new-password-fail', 'Your New Password cannot be same as your current password! Please choose a different password.');
            return back()->with([
                'new_password_msg' => 'New Password cannot be same as your current password! Please choose a different password.',
            ]);
            return back();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        Auth::logout();
        session()->flash('password-success', 'Password Updated Successfully! Please Login.');

        return redirect()->route('login');
    }
}
