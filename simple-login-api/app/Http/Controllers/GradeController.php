<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Semester;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return Grade::with('user')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'npm' => 'required|exists:users,npm',
            'subject_name' => 'required|string',
            'grade' => 'required|string',
            'grade_point' => 'required|numeric',
            'sks' => 'required|numeric',
            'semester_id' => 'nullable|exists:semesters,id'
        ]);

        return Grade::create($data);
    }
    public function getGradesBySemester($npm, $semester_id)
    {
        $semester = Semester::with(['grades' => function ($query) use ($npm) {
            $query->where('npm', $npm);
        }])->where('id', $semester_id)->first();

        if (!$semester) {
            return response()->json(['message' => 'Semester tidak ditemukan'], 404);
        }

        return response()->json($semester);
    }

}
