<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResourceController;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// ---------- Public Routes ----------

// Student Register
Route::post('/register', function (Request $request) {
    $fields = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password']),
    ]);

    $token = $user->createToken('tutoring-token')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 201);
});

// Student Login
Route::post('/login', function (Request $request) {
    $fields = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $fields['email'])->first();

    if (!$user || !Hash::check($fields['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('tutoring-token')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token]);
});

// Teacher Login
Route::post('/teacher/login', function (Request $request) {
    $fields = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $teacher = Teacher::where('email', $fields['email'])->first();

    if (!$teacher || !Hash::check($fields['password'], $teacher->password)) {
        return response()->json(['message' => 'Invalid teacher credentials'], 401);
    }

    $token = $teacher->createToken('teacher-token')->plainTextToken;

    return response()->json(['teacher' => $teacher, 'token' => $token]);
});

Route::post('/teacher', [TeacherController::class, 'store']);


// ---------- Protected Routes (Students + Teachers via Sanctum) ----------

Route::middleware('auth:sanctum')->group(function () {

    // 👤 Authenticated user info
    Route::get('/me', fn(Request $request) => $request->user());

    // 📋 Users list (for payment assignment)
    Route::get('/users', fn() => \App\Models\User::select('id', 'name', 'email')->get());

    // 📚 Sessions
    Route::get('/sessions', [SessionController::class, 'index']);
    Route::post('/sessions', [SessionController::class, 'store']);

    // 💵 Payments
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments', [PaymentController::class, 'store']);

    // 🧑‍🏫 Teacher Profile
    Route::get('/teacher', [TeacherController::class, 'show']);
    Route::put('/teacher', [TeacherController::class, 'update']);
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard']);

    // 📘 Courses
    Route::get('/courses', [CourseController::class, 'index']); // Filtered by token owner
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    // 📎 Resources per course
    Route::get('/courses/{courseId}/resources', [ResourceController::class, 'index']);
    Route::post('/courses/{courseId}/resources', [ResourceController::class, 'store']);
    Route::delete('/resources/{id}', [ResourceController::class, 'destroy']);
});

// ---------- Ping Test ----------
Route::get('/ping', fn () => ['message' => 'pong']);
