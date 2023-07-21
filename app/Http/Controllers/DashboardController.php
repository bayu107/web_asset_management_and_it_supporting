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

        if($user->user_level == 1){
            return view('userdashboard');
        }else{
            return view('dashboard');
        }
    }
}

