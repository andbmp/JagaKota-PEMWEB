<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
{
    // 1. Ubah validasi agar tidak error saat NIK/Phone kosong
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'nik' => 'nullable|string|max:20',    // Ganti required jadi nullable
        'phone' => 'nullable|string|max:15',  // Ganti required jadi nullable
    ]);

$user = User::create([
    'name'     => $validated['name'],
    'email'    => $validated['email'],
    'password' => Hash::make((string)$validated['password']), // Tambahkan (string)
    'nik'      => $request->nik ?? null,
    'phone'    => $request->phone ?? null,
]);

    Auth::login($user); // Otomatis login setelah daftar
    return redirect('/dashboard'); // Pindah ke dashboard
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    // Kita sudah tahu password cocok dari hasil debug tadi
    if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        
        // Memulai session login
        \Illuminate\Support\Facades\Auth::login($user, true); // true = remember me
        
        $request->session()->regenerate();

        // Paksa pindah ke dashboard
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'Login gagal, periksa kembali data Anda.']);
}

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    // Get User Profile
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    // Update User Profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'sometimes|string|max:15',
            // Add other fields as necessary
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }
}