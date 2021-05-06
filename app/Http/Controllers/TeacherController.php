<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     */
    public function create_teacher(Request $request)
    {
        // Get validation rules
        // $validate =
        $this->create_teacher_rules($request);

        // Run validation
        // if ($validate->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $validate->errors(),
        //         'status' => 400,
        //     ]);
        // }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->teacher()->create([
            'gender' => $request->gender,
            'teacher_phone' => $request->teacher_phone,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ]);

        $user->assignRole('Teacher');

        // $teacher = new Teacher();

        // $teacher->first_name = $request->first_name;
        // $teacher->last_name = $request->last_name;
        // $teacher->teacher_email = strtolower($request->teacher_email);
        // $teacher->password = Hash::make(strtolower($request->password));
        // $teacher->gender = $request->gender;
        // $teacher->teacher_phone = $request->teacher_phone;
        // $teacher->date_of_birth = $request->date_of_birth;
        // $teacher->current_address = $request->current_address;
        // $teacher->permanent_address = $request->permanent_address;

        return redirect()->back();

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_teacher_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'teacher_email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'teacher_phone' => 'required|numeric|digits_between:5,11|unique:teachers,phone',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
        ]);
    }
}
