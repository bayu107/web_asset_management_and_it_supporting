<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users',
            'user_password' => ['required', Password::min(8)],
            //'user_level' => 'required|integer',
            //'user_group_id' => 'required|integer',
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_level' => 1, // Atur nilai 'user_level' sesuai kebutuhan
            //'user_group_id' => $request->user_group_id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_name' => 'required|string|max:255',
    //         'user_email' => 'required|email|unique:users',
    //         'user_password' => ['required', Password::min(8)],
    //         'user_level' => 'required|integer',
    //         //'user_group_id' => 'required|integer',
    //     ]);

    //     $user = User::create([
    //         'user_name' => $request->user_name,
    //         'user_email' => $request->user_email,
    //         'user_password' => Hash::make($request->user_password),
    //         'user_level' => $request->user_level,
    //         //'user_group_id' => $request->user_group_id,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $user,
    //     ]);
    // }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,user_email,' . $user->id,
            'user_password' => [Password::min(8)],
            'user_level' => 'required|integer',
            'user_group_id' => 'required|integer',
        ]);

        $user->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_level' => $request->user_level,
            'user_group_id' => $request->user_group_id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required',
        ]);

        $user = User::where('user_email', $request->user_email)->first();

        if (! $user || ! Hash::check($request->user_password, $user->user_password)) {
        throw ValidationException::withMessages([
            'user_email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken('Login')->plainTextToken;

         return response()->json([
                'success' => true,
                'token' => $token,
                'token_type' => 'Bearer',
                'data' => [
                    'user' => $user,
                ],
            ]);
    }
    
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    
        return response()->json(
            [
                'message' => 'Successfully logged out'
            ]
        );
    }
    
}
