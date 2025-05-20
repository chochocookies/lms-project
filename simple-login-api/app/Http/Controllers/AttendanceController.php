<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        return Attendance::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required|exists:users,id',
            'date' => 'required|date',
            'status' => 'required|string',
            'description' => 'nullable|string'
        ]);

        return Attendance::create($data);
    }
}
