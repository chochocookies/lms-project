<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseTakenController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SemesterController;
use Illuminate\Support\Facades\Log;

// ==========================
// Public Endpoints (No Auth)
// ==========================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ==============================
// Protected Endpoints (With Auth)
// ==============================
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // User profile (basic info)
    Route::get('/profile', [UserController::class, 'profile']);

    // Optional: Raw user data with full relation
    Route::get('/user', function (Request $request) {
        $user = $request->user();

        $user->load([
            'grade' => function ($query) use ($user) {
                $query->where('npm', $user->npm);
            },
            'semester' => function ($query) use ($user) {
                $query->where('npm', $user->npm);
            },
            'attendance' => function ($query) use ($user) {
                $query->where('npm', $user->npm);
            },
            'courseTakens' => function ($query) use ($user) {
                $query->where('npm', $user->npm);
            },
        ]);

        Log::info('API hit by user', ['user' => $user]);

        return response()->json($user);
    });

    // Alias route: /user/profile
    Route::get('/user/profile', function (Request $request) {
        $user = $request->user();

        $user->load([
            'grade' => fn($q) => $q->where('npm', $user->npm),
            'semester' => fn($q) => $q->where('npm', $user->npm),
            'attendance' => fn($q) => $q->where('npm', $user->npm),
            'courseTaken' => fn($q) => $q->where('npm', $user->npm),
        ]);

        Log::info('Full profile retrieved', ['npm' => $user->npm]);

        return response()->json($user);
    });

    // ====================
    // Attendance Endpoints
    // ====================
    Route::get('/attendances', [AttendanceController::class, 'index']);
    Route::post('/attendances', [AttendanceController::class, 'store']);

    // ========================
    // Course Taken Endpoints
    // ========================
    Route::get('/course-takens', [CourseTakenController::class, 'index']);
    Route::post('/course-takens', [CourseTakenController::class, 'store']);

    // ====================
    // Grade Endpoints
    // ====================
    Route::get('/grades', [GradeController::class, 'index']);
    Route::post('/grades', [GradeController::class, 'store']);

    // ====================
    // Semester Endpoints
    // ====================
    Route::get('/semesters', [SemesterController::class, 'index']);
    Route::post('/semesters', [SemesterController::class, 'store']);
});
