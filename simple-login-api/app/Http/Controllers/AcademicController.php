<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function getIpk(Request $request)
    {
        $user = $request->user();

        $grades = $user->grades;
        $totalSks = $grades->sum('sks');
        $totalBobot = $grades->sum(fn($grade) => $grade->sks * $grade->grade_point);

        $ipk = $totalSks > 0 ? round($totalBobot / $totalSks, 2) : 0;

        return response()->json([
            'ipk' => $ipk,
            'total_sks' => $totalSks,
            'total_bobot' => $totalBobot,
            'grades' => $grades
        ]);
    }

    public function getSemester(Request $request)
    {
        $user = $request->user();
        return response()->json($user->semesters);
    }

    public function getAttendance(Request $request)
    {
        $user = $request->user();
        return response()->json($user->attendances);
    }

    public function getCredits(Request $request)
    {
        $user = $request->user();
        $courses = $user->coursesTaken;
        $totalCredits = $courses->sum('sks');

        return response()->json([
            'total_credits' => $totalCredits,
            'courses' => $courses,
        ]);
    }
}
