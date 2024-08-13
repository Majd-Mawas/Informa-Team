<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CourseCollection(Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = new Course;

        $course->Name = $request->name;
        $course->By = $request->by;
        $course->difficulty = $request->difficulty;
        $course->type = $request->type;
        $course->duration = $request->duration;
        $course->num_video = $request->num_video;
        $course->released_at = $request->released_at;
        $course->categories_id  = $request->categories_id;

        $course->save();

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $course->Name = $request->name;
        $course->By = $request->by;
        $course->difficulty = $request->difficulty;
        $course->type = $request->type;
        $course->duration = $request->duration;
        $course->num_video = $request->num_video;
        $course->released_at = $request->released_at;

        if (isset($request->categories_id))
            $course->categories_id  = $request->categories_id;

        $course->save();

        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json(['data' => 'course deleted successfully']);
    }
}
