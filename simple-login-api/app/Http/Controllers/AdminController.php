<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'npm', 'email', 'role')->get();

        return response()->json(['users' => $users]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => ['required', 'string', Rule::in(['admin', 'student', 'user'])],
            'npm' => 'nullable|string|unique:users,npm',
        ]);

        // Jika role student, npm wajib
        if ($validated['role'] === 'student' && empty($validated['npm'])) {
            return response()->json(['message' => 'NPM wajib diisi untuk role student'], 422);
        }

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return response()->json(['message' => 'User created', 'user' => $user], 201);
    }

    public function show($id)
    {
        $user = User::with([
            'grade',
            'semester',
            'courseTaken',
            'attendance'
        ])->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => ['sometimes', 'required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['sometimes', 'required', 'string', Rule::in(['admin', 'student', 'user'])],
            'npm' => ['nullable', 'string', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validated['role']) && $validated['role'] === 'student' && empty($validated['npm'])) {
            return response()->json(['message' => 'NPM wajib diisi untuk role student'], 422);
        }

        // Update password jika ada
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json(['message' => 'User updated', 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
