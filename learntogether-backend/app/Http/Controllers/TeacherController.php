<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // Get all teachers
    public function index()
    {
        return Teacher::with('user')->get();
    }

    // Show a single teacher
    public function show($id)
    {
        $teacher = Teacher::with('user', 'courses')->findOrFail($id);
        return response()->json($teacher);
    }

    // Create a teacher profile
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|string|min:6',
            'bio' => 'nullable|string',
            'specialty' => 'nullable|string',
            'availability' => 'nullable|string',
            'profile_picture' => 'nullable|string',
        ]);
    
        $teacher = Teacher::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'bio' => $validated['bio'] ?? '',
            'specialty' => $validated['specialty'] ?? '',
            'availability' => $validated['availability'] ?? '',
            'profile_picture' => $validated['profile_picture'] ?? null,
        ]);
    
        return response()->json($teacher, 201);
    }
    

    public function dashboard(Request $request)
    {
        $teacher = Teacher::where('user_id', $request->user()->id)->first();

        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }

        $courses = $teacher->courses()->latest()->get();

        return response()->json([
            'teacher' => $teacher,
            'courses' => $courses
        ]);
    }

}
