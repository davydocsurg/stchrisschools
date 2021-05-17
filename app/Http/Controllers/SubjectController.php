<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('teacher')->latest()->paginate(10);

        return view('backend.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::latest()->get();

        return view('backend.subjects.create', compact('teachers'));
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
        $validate = $this->create_subject_rules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        Subject::create([
            'subject_name' => $request->subject_name,
            'slug' => Str::slug($request->subject_name),
            'subject_code' => $request->subject_code,
            'teacher_id' => $request->teacher_id,
            'subject_description' => $request->subject_description,
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_subject_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'subject_name' => 'required|string|max:255|unique:subjects,subject_name',
            'subject_description' => 'required|string|max:255|unique:subjects',
            'subject_code' => 'required|numeric',
            'teacher_id' => 'required|numeric',

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
    public function edit(Subject $subject)
    {
        $teachers = Teacher::latest()->get();

        return view('backend.subjects.edit', compact('subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255|unique:subjects,subject_name,' . $subject->id,
            'subject_code' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'subject_description' => 'required|string|max:255',
        ]);

        $subject->update([
            'subject_name' => $request->subject_name,
            'slug' => Str::slug($request->subject_name),
            'subject_code' => $request->subject_code,
            'teacher_id' => $request->teacher_id,
            'subject_description' => $request->subject_description,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back();
    }
}
