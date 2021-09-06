<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function adminSignUp(Request $request)
    {
        return view('admin.signup');
    }

    public function welcome()
    {
        $users = User::latest()->get();
        $parents = Parents::latest()->get();
        $teachers = Teacher::latest()->get();
        $students = Student::latest()->get();

        return view('landing', compact('users', 'parents', 'teachers', 'students'));
    }

    public function aboutUs()
    {
        return view('about_us');
    }

    public function ourServices()
    {
        return view('our_services');
    }

    public function contactUs()
    {
        return view('contact_us');
    }

    // registration
    public function remedialPage()
    {
        return view('registration_pages.remedials');
    }
}
