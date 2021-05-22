<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);

        return view('backend.assignRole.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();

        return view('backend.assignRole.create', compact('roles'));
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

        // get Validation rules
        $validate = $this->create_user_rules($request);

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
            'password' => $request->password,
        ]);

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

        $user->assignRole($request->role);

        // Try user save or catch error if any
        try {
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Parent Updated Successful',
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
    public function create_user_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:8',

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
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::latest()->get();

        return view('backend.assignRole.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        if ($request->password) {
            $user->password = $request->password;
        }

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
        ]);

        $user->syncRoles($request->selectedRole);

        // Try user save or catch error if any
        try {
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Parent Updated Successful',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        dd($user->id);
        // $user = User::with('roles')->findOrFail($id);
        // // $user = User::findOrFail($user->id);
        // $user->removeRole($user->role);

        // $photo = $user->profile_picture;
        // $photo != 'avatar.png' ? Storage::delete('/public/users/profile/' . $photo) : null;
        // $user->delete();

        // return back();

    }
}
