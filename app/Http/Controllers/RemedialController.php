<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Remdial;
use App\Remedial;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RemedialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Remdial::with('remedial_class')->latest()->paginate(10);

        return view('backend.remedials.index', compact('remedials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Grade::latest()->get();

        return view('backend.remedials.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Get validation rules
        $validate = $this->create_remedial_rules($request);

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

        } else {
            $photo = $user->profile_picture;
        }

        $user->remedial()->create([
            'gender' => $request->gender,
            'remedial_phone' => $request->remedial_phone,
            'roll_number' => $request->roll_number,
            'class_id' => $request->class_id,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ]);

        $user->assignRole('Remedial');

        // Try user save or catch error if any
        try {
            $user->save();
            // $old != 'avatar.png' ? Storage::delete('/public/users/profile/' . $old) : null;

            return response()->json([
                'success' => true,
                'message' => 'Student Created Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            // Delete file
            Storage::delete('/public/users/profile/' . $upload);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_remedial_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'class_id' => 'required|numeric',
            'roll_number' => [
                'required',
                'numeric',
                Rule::unique('remedials')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                }),
            ],
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'remedial_phone' => 'required|numeric|digits_between:5,11|unique:remedials,remedial_phone',
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
    public function edit(Remedial $remedial)
    {
        $classes = Grade::latest()->get();

        return view('backend.remedials.edit', compact('classes', 'student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remdial $remedial)
    {
        // validate request
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $remedial->user_id,
            'class_id' => 'required|numeric',
            'roll_number' => [
                'required',
                'numeric',
                Rule::unique('students')->ignore($remedial->id)->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                }),
            ],
            // 'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|string',
            'student_phone' => 'required|numeric|digits_between:5,11|unique:parents,parent_phone',
            'date_of_birth' => 'required|date',
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($remedial->user_id);

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
                Storage::delete('/public/users/profile/' . $photo);

                return response()->json([
                    'success' => false,
                    'message' => 'Oops! Something went wrong. Try Again!',
                    'status' => 400,
                ]);
            }

        } else {
            $photo = $user->profile_picture;
        }

        $remedial->user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        $remedial->update([
            'gender' => $request->gender,
            'remedial' => $request->remedial,
            'roll_number' => $request->roll_number,
            'class_id' => $request->class_id,
            'date_of_birth' => $request->date_of_birth,
            'current_address' => $request->current_address,
            'permanent_address' => $request->permanent_address,
        ]);

        // Try user save or catch error if any
        try {
            $user->save();
            // $old != 'avatar.png' ? Storage::delete('/public/users/profile/' . $old) : null;

            return response()->json([
                'success' => true,
                'message' => 'Student Updated Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            // Delete file
            Storage::delete('/public/users/profile/' . $upload);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remedial $remedial)
    {
        $user = User::findOrFail($remedial->user_id);

        $user->removeRole('Remedial');

        if ($user->delete()) {
            $photo = $remedial->profile_picture;
            $photo != 'avatar.png' ? Storage::delete('/public/users/profile/' . $photo) : null;

        }
        $user->remedial()->delete();

        return back();
    }
}
