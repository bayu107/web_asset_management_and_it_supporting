<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
                    return $query->where('user_name', 'like', '%' . $search . '%')
                                ->orWhere('user_email', 'like', '%' . $search . '%');
                })
                ->paginate(10);

        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|unique:users,user_email',
            'user_password' => 'required',
            'user_level' => 'required',
        ]);

        $validatedData['user_password'] = Hash::make($validatedData['user_password']);

        User::create($validatedData);

        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|unique:users,user_email,' . $user->id,
            'user_password' => 'required',
            'user_level' => 'required',
        ]);

        $validatedData['user_password'] = Hash::make($validatedData['user_password']);

        $user->update($validatedData);

        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success', 'User deleted successfully.');
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

}
