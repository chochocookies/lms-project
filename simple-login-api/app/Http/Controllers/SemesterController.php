<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function index()
    {
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
