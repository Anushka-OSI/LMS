<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.usermanage', compact('users'));
    }

    // Show the edit form for a specific user
    public function edit(User $user)
    {
        return view('admin.useredit', compact('user'));
    }

    // Update a user's information
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|max:255',
            'password' => 'nullable|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));

        }

        $user->save();

        return redirect('user/manage')->with('success', 'User information updated successfully');
    }
}
