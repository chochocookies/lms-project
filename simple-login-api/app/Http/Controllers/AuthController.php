<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $request->headers->set('Accept', 'application/json');
        Log::info('Register attempt:', $request->all());

        try {
            $validator = Validator::make($request->all(), [
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed|min:8',
                'role'     => 'required|string|in:student,admin'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
                // 'npm' dibuat otomatis di model
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Registrasi berhasil',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Register error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Terjadi kesalahan saat registrasi.',
                'error' => $e->getMessage(),
            ], 500);
    }
    }

    // Login
    public function login(Request $request)
    {
        $request->headers->set('Accept', 'application/json');

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // --- Perbaikan di sini: Eager load relasi ---
        $user->load(['grade', 'semester', 'attendance', 'courseTaken']);
        // ---------------------------------------------

        // Opsional: login secara manual
        // Auth::login($user); // Baris ini sebenarnya tidak perlu untuk API Stateless (Sanctum)

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user, // Sekarang $user akan berisi data relasional lengkap
        ]);
    }

    // ... logout method ...

    // Profile
    // Method profile sudah benar dalam eager loading
    public function profile(Request $request)
    {
        $user = $request->user()->load([
            'grade',
            'semester',
            'attendance',
            'courseTaken'
        ]);

        return response()->json([
            'user' => $user
        ]);
    }
}


