<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseTakenController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        $user = $request->user();

        $user->load([
            'grade' => fn($q) => $q->where('npm', $user->npm),
            'semester' => fn($q) => $q->where('npm', $user->npm),
            'attendance' => fn($q) => $q->where('npm', $user->npm),
            'courseTaken' => fn($q) => $q->where('npm', $user->npm),
        ]);

        Log::info('Student profile retrieved', ['npm' => $user->npm]);

        return response()->json($user);
    });

    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::post('/attendance', [AttendanceController::class, 'store']);

    Route::get('/course-taken', [CourseTakenController::class, 'index']);
    Route::post('/course-taken', [CourseTakenController::class, 'store']);

    Route::get('/grade', [GradeController::class, 'index']);
    Route::post('/grade', [GradeController::class, 'store']);

    Route::get('/semester', [SemesterController::class, 'index']);
    Route::post('/semester', [SemesterController::class, 'store']);
});

// Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
//     Route::get('user', [AdminController::class, 'index']);
//     Route::post('user', [AdminController::class, 'store']);
//     Route::get('user/{id}', [AdminController::class, 'show']);
//     Route::put('user/{id}', [AdminController::class, 'update']);
//     Route::delete('user/{id}', [AdminController::class, 'destroy']);
// });

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AdminController::class, 'index']);
    Route::post('/user', [AdminController::class, 'store']);
    Route::get('/user/{id}', [AdminController::class, 'show']);
    Route::put('/user/{id}', [AdminController::class, 'update']);
    Route::delete('/user/{id}', [AdminController::class, 'destroy']);
});
