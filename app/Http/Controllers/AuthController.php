<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required',
        ]);

        $user = User::where('user_email', $request->user_email)->first();

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login1');
    }

    public function login1(Request $request)
    {
        $credentials = $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required|string',
        ]);

        if (auth()->attempt($credentials)) {
            // Jika autentikasi berhasil, redirect ke halaman dashboard atau halaman lain yang diinginkan
            return redirect('/dashboard');
        } else {
            // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->back()->withErrors(['Invalid credentials. Please try again.']);
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users',
            'user_password' => 'required|string|min:8',
            'user_level' => 'required|integer',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_level' => $request->user_level,
        ]);

        return redirect('/login')->with('success', 'Registration successful. You can now log in.');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout successful.');
    }
}
