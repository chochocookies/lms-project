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
        'user' => $user
    ]);
    }
}
