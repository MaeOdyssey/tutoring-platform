<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $teacher = $request->user(); // gets the teacher from Sanctum token
    
        $courses = $teacher->courses()->orderBy('created_at', 'desc')->get();
    
        return response()->json($courses);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fee' => 'required|numeric|min:0',
            'document' => 'nullable|string'
        ]);

        $course = Course::create($validated);

        return response()->json($course, 201);
    }

    public function show($id)
    {
        return Course::with('teacher')->findOrFail($id);
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response()->json(['message' => 'Course deleted']);
    }
}
