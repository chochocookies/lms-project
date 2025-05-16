<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user()->load([
            'grade', 'semester', 'attendance', 'courseTaken'
        ]);

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'photo' => $user->photo,
                'gpa' => $user->grade->gpa ?? null,
                'semester' => $user->semester->name ?? null,
                'attendance' => $user->attendance->percentage ?? null,
                'credits' => $user->courseTaken->credits ?? null,
            ]
        ]);
    }
}
