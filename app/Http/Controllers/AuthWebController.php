<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthWebController extends Controller
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (!$this->authenticate($request, $guards)) {
            return redirect()->route('login');
        }

        return $next($request);
    }

    public function __construct()
    {
        $this->middleware('auth')->only('showDashboard');
    }    

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required|string',
        ]);
    
        $credentials = $request->only('user_email', 'user_password');
    
        $user = User::where('user_email', $credentials['user_email'])->first();
    
        if ($user && Hash::check($credentials['user_password'], $user->user_password)) {
            // Jika autentikasi berhasil, redirect ke halaman dashboard
            return redirect()->route('dashboard');
        } else {
            // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users',
            'user_password' => 'required|string|min:6|confirmed',
        ]);

        $user_level = 1;

        // Simpan user baru ke database
        // Misalnya, menggunakan model User yang memiliki kolom yang sesuai dengan migrasi
        $user = User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => bcrypt($request->user_password),
            'user_level' => $user_level,
        ]);
        

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
