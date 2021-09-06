<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lessons = Lesson::with(['teacher'])->latest()->paginate(10);
        $lessons = Lesson::with('class_lesson')->orderBy('id', 'DESC')->paginate(10);
        // dd($lessons);
        return view('backend.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Grade::latest()->get();

        return view('backend.lessons.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lesson $lesson)
    {
        // dd($request->all());
        // Get validation rules
        $validate = $this->create_lesson_rules($request);

        // Run validation
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors(),
                'status' => 400,
            ]);
        }

        // upload video
        if ($request->hasFile('lesson_video')) {
            // validate video
            $validateVid = $this->lesson_vid_rules($request);

            // Run validation
            if ($validateVid->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validateVid->errors(),
                    'status' => 400,
                ]);
            }
            // Attempt Video Upload
            $uploadVid = Storage::put('/public/lessons/videos', $request->lesson_video);
            $video = basename($uploadVid);

            $lesson->lesson_video = $video;

            if (!$uploadVid) {
                Storage::delete('/public/lessons/videos' . $video);

                return response()->json([
                    'success' => false,
                    'message' => 'Oops! Something went wrong. Try Again!',
                    'status' => 400,
                ]);
            }

        }
        // else {
        //     $video = $lesson->lesson_video;
        // }
        $lesson->lesson_title = $request->lesson_title;
        $lesson->lesson_description = $request->lesson_description;
        $lesson->class_id = $request->class_id;
        $lesson->slug = Str::slug($request->lesson_title);

        // Try lesson save or catch error if any
        try {
            $lesson->save();

            return response()->json([
                'success' => true,
                'message' => 'Lesson Created Successfully',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            // Delete file
            // Storage::delete('/public/lessons/videos' . $uploadVid);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function create_lesson_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'lesson_title' => 'required|string|max:255|unique:lessons,lesson_title',
            'lesson_description' => 'required|string|max:255|unique:lessons,lesson_description',
            'class_id' => 'required|numeric',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  request  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function lesson_vid_rules(Request $request)
    {
        // Make and return validation rules
        return Validator::make($request->all(), [
            'lesson_video' => 'file|unique:lessons,lesson_video',
            // 'lesson_video' => 'file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|unique:lessons,lesson_video',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        $classes = Grade::latest()->get();
        $lesson = Lesson::findOrFail($lesson->id);
        return view('backend.lessons.show', compact('lesson', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        $classes = Grade::latest()->get();
        $lesson = Lesson::findOrFail($lesson->id);
        return view('backend.lessons.edit', compact('lesson', 'classes'));
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
        // validate requests
        $request->validate([
            // 'lesson_title' => 'required|string|max:255|unique:lessons,lesson_title,' . $lesson->lesson_title,
            // 'lesson_description' => 'required|string|max:255|unique:lessons,lesson_description,' . $lesson->lesson_description,
            // 'class_id' => 'required|string|max:255|unique:lessons,class_id,' . $lesson->class_id,
            'lesson_title' => 'required|string|max:255|unique:lessons,lesson_title,' . $id,
            'lesson_description' => 'required|string|max:255',
            'class_id' => 'required|numeric',
        ]);

        $lesson = Lesson::findOrFail($id);

        // upload video
        if ($request->hasFile('lesson_video')) {
            // validate video
            $request->validate([
                'lesson_video' => 'file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|unique:lessons,lesson_video,' . $lesson->lesson_video,
            ]);
            // $validateVid = $this->lesson_vid_rules($request);

            // Run validation
            // if ($validateVid->fails()) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => $validateVid->errors(),
            //         'status' => 400,
            //     ]);
            // }
            // Attempt Video Upload
            $uploadVid = Storage::put('/public/lessons/videos', $request->lesson_video);
            $video = basename($uploadVid);

            $lesson->lesson_video = $video;

            if (!$uploadVid) {
                Storage::delete('/public/lessons/videos' . $video);

                return response()->json([
                    'success' => false,
                    'message' => 'Oops! Something went wrong. Try Again!',
                    'status' => 400,
                ]);
            }

        }

        $lesson->lesson_title = $request->lesson_title;
        $lesson->lesson_description = $request->lesson_description;
        $lesson->class_id = $request->class_id;
        $lesson->slug = Str::slug($request->lesson_title);

        // Try lesson save or catch error if any
        try {
            $lesson->save();

            return response()->json([
                'success' => true,
                'message' => 'Lesson Created Successful',
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            // Delete file
            // Storage::delete('/public/lessons/videos' . $uploadVid);
            return response()->json(['success' => false, 'status' => 500, 'message' => 'Oops! Something went wrong. Try Again!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
