<?php
// LoginController.php

namespace App\Http\Controllers\Auth;

// use session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('user_email', 'user_password');

        $user = User::where('user_email', $credentials['user_email'])->first();

        if ($user && Hash::check($credentials['user_password'], $user->user_password)) {
            session(['user' => $user]);
            // Autentikasi berhasil, arahkan ke halaman dashboard
            return redirect()->route('dashboard')->with('success', 'Login successful!');
            // return redirect()->route('dashboard');
        } else {
            // Autentikasi gagal, arahkan kembali ke halaman login dengan pesan error
            return redirect()->route('login')->withErrors(['error' => 'Invalid credentials']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

