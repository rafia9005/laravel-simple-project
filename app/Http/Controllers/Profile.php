<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; // Add this import statement

class Profile extends Controller
{
    public function index()
    {
        $title = 'Profile | ngodingsantuy.site';
        $user = Auth::user();
        $userName = $user->name;

        return view('profile', compact('title', 'userName', 'user'));
    }

    public function editEmail()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route('profile')->with('success', 'Email updated successfully!');
    }

    public function editUsername()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updateUsername(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $validatedData['name'];
        $user->save();

        return redirect()->route('profile')->with('success', 'Username updated successfully!');
    }

    public function editPassword()
    {
        return view('profile');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = bcrypt($validatedData['password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully!');
    }
}
