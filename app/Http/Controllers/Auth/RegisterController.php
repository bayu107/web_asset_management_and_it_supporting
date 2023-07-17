<?php
// RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validasi input
    $this->validate($request, [
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|string|email|unique:users|max:255',
        'user_password' => 'required|string|min:8|confirmed',
    ]);

    // Buat user baru
    User::create([
        'user_name' => $request->user_name,
        'user_email' => $request->user_email,
        'user_password' => bcrypt($request->user_password),
        'user_level' => 1, // Atur level sesuai kebutuhan
    ]);

    // Redirect ke halaman login setelah berhasil register
    return redirect()->route('login')->with('success', 'Registration successful!');
}


}
