<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        User::with(['grade', 'semester', 'attendance', 'courseTaken'])->get();

        return Attendance::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required|exists:users,npm',
            'date' => 'required|date',
            'status' => 'required|string',
            'description' => 'nullable|string'
        ]);

        return Attendance::create($data);
    }
}
