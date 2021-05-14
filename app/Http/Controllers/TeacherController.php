<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->paginate(10);

        return view('backend.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            // dd($request->profile_picture);
            // Get validation rules
            $validate = $this->create_teacher_rules($request);

            // Run validation
            if ($validate->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validate->errors(),
                    'status' => 400,
                ]);
            }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->hasFile('profile_picture')) {
                // $old = $user->profile_picture;
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

                if (!$upload) {
                    Storage::delete('/public/users/profile' . $photo);

                    return response()->json([
                        'success' => false,
                        'message' => 'Oops! Something went wrong. Try Again!',
                        'status' => 400,
                    ]);
                }
                // $profile = Str::slug($user->first_name) . '-' . $user->id . '.' . $request->profile_picture->getClientOriginalExtension();
                // $request->profile_picture->move(public_path('images/profile'), $profile);
            } else {
                $photo = $user->profile_picture;
            }

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
                // $old != 'avatar.png' ? Storage::delete('/public/users/profile/' . $old) : null;

                return response()->json([
                    'success' => true,
                    'message' => 'Teacher\'s Signup Successful',
                    'status' => 200,
                ]);
            } catch (\Throwable $th) {
                Log::error($th);
                // Delete file
                Storage::delete('/public/users/profile' . $upload);
                return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
            }

        }
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'teacher_phone' => 'required|numeric|digits_between:5,11|unique:teachers,teacher_phone',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $teacher = Teacher::with('user')->findOrFail($teacher->id);

        return view('backend.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        // dd($request->all());
        // dd($request->profile_picture);

        // $validate = $this->update_teacher_rules($request, $teacher);
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->user_id,
            'gender' => 'required|string',
            'teacher_phone' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
        ]);

        // Run validation
        // if ($validate->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $validate->errors(),
        //         'status' => 400,
        //     ]);
        // }

        $user = User::findOrFail($teacher->user_id);

        // if ($request->hasFile('profile_picture')) {
        //     $profile = Str::slug($user->name).'-'.$user->id.'.'.$request->profile_picture->getClientOriginalExtension();
        //     $request->profile_picture->move(public_path('images/profile'), $profile);
        // } else {
        //     $profile = $user->profile_picture;
        // }

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

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        $user->teacher()->update([
            'gender' => $request->gender,
            'teacher_phone' => $request->teacher_phone,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ]);

        // Try user save or catch error if any
        try {
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Teacher\'s Update Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            // Delete file
            Storage::delete('/public/users/profile' . $upload);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function update_teacher_rules(Request $request, Teacher $teacher)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users' . $teacher->user_id,
            'gender' => 'required|string',
            // 'password' => 'sometimes|string|min:8|confirmed',
            'teacher_phone' => 'required|numeric|digits_between:5,11|unique:teachers,teacher_phone',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        // dd($teacher->user_id);
        $user = User::findOrFail($teacher->user_id);

        $user->removeRole('Teacher');

        if ($user->delete()) {
            $photo = $teacher->profile_picture;
            $photo != 'avatar.png' ? Storage::delete('/public/users/profile/' . $photo) : null;

        }
        $user->teacher()->delete();

        return back();
    }
}
