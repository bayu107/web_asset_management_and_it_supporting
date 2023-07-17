<?php
// DashboardController.php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user = session('user');
        $user_level = $user->user_level;
        
        return view('dashboard', compact('user_level'));
        // if($user ==  null) {
        //     return "Anda blum Login";
        // } else {
        //     return view('dashboard', compact('user_level'));
        // }
    }
}

