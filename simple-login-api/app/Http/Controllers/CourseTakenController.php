<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CourseTaken;
use Illuminate\Http\Request;

class CourseTakenController extends Controller
{
    public function index()
    {
        User::with(['grade', 'semester', 'attendance', 'courseTaken'])->get();
        return CourseTaken::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required|exists:users,npm',
            'course_name' => 'required|string',
            'sks' => 'required|numeric',
            'semester' => 'required|string'
        ]);

        return CourseTaken::create($data);
    }
}
