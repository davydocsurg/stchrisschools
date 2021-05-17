<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Grade::withCount('students')->latest()->paginate(10);

        return view('backend.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::latest()->get();

        return view('backend.classes.create', compact('teachers'));
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
        $validate = $this->create_grade_rules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        Grade::create([
            'class_name' => $request->class_name,
            'class_numeric' => $request->class_numeric,
            'teacher_id' => $request->teacher_id,
            'class_description' => $request->class_description,
        ]);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_grade_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'class_name' => 'required|string|max:255|unique:grades,class_name',
            'class_description' => 'required|string|max:255|unique:grades',
            'class_numeric' => 'required|numeric',
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
    public function edit($id)
    {
        $teachers = Teacher::latest()->get();
        $class = Grade::findOrFail($id);
        // dd($class->id);

        return view('backend.classes.edit', compact('class', 'teachers'));
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
        // dd($request->all());
        $request->validate([
            'class_name' => 'required|string|max:255|unique:grades,class_name,' . $id,
            'class_numeric' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'class_description' => 'required|string|max:255',
        ]);

        $class = Grade::findOrFail($id);

        $class->update([
            'class_name' => $request->class_name,
            'class_numeric' => $request->class_numeric,
            'teacher_id' => $request->teacher_id,
            'class_description' => $request->class_description,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Grade::findOrFail($id);

        $class->subjects()->detach();
        $class->delete();

        return back();
    }

    /*
     * Assign Subjects to Grade
     *
     * @return \Illuminate\Http\Response
     */
    public function assignSubjectToGrade($classId)
    {
        $subjects = Subject::latest()->get();
        $assigned = Grade::with(['subjects', 'students'])->findOrFail($classId);

        return view('backend.classes.assign_subject_to_grade', compact('classId', 'subjects', 'assigned'));
    }

    /*
     * Add Assigned Subjects to Grade
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAssignedSubject(Request $request, $id)
    {
        // $request->all();
        $class = Grade::findOrFail($id);

        $class->subjects()->sync($request->selected_subjects);

        return redirect()->route('classes.index');
    }
}
