<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Grade $grade)
    {
        $teacher_classes = Grade::withCount('teacher', 'subjects', 'students')->orderBy('id', 'desc')->paginate(10);
        // dd($teacher_student);
        return view('backend.teacher_classes.index', compact('teacher_classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher, $id)
    {
        // $grade = Grade::findOrFail($teacher->id);
        $teacher_classes = Grade::withCount('teacher', 'subjects', 'students')->orderBy('id', 'desc')->paginate(10);

        $class_details = Grade::where('teacher_id', $id)->with('teacher', 'subjects', 'students')->get();
        dd($class_details);
        return view('backend.teacher_classes.show', compact('teacher_class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
