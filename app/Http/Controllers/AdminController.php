<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Process User Signup
     * @return json
     */
    public function signup(Request $request)
    {
        dd($request);
        // Get validation rules
        $validate = $this->signup_rules($request);

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
        // $user->phone = $request->phone;
        $user->password = Hash::make(strtolower($request->password));

        // Try user save or catch error if any
        try {
            $user->save();

            // Attempt login
            $this->fast_login($request);

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
    public function signup_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => 'required|email|unique:users', // email:rfc,dns should be used in production
            'phone' => 'required|numeric|digits_between:5,11|unique:users,phone',
            'password' => 'required|alpha_dash|min:8|max:30|confirmed',
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
