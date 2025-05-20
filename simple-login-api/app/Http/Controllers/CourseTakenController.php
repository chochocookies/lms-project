<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseTaken;

class CourseTakenController extends Controller
{
    public function index()
    {
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
