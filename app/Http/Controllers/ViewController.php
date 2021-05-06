<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function adminSignUp(Request $request)
    {
        return view('admin.signup');
    }
}
