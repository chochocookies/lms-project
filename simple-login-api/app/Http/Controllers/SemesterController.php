<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        User::with(['grade', 'semester', 'attendance', 'courseTaken'])->get();
        return Semester::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required|exists:users,npm',
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        return Semester::create($data);
    }
}
