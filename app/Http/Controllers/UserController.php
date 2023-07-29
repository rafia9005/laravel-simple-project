<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Other methods...

    public function index()
    {
        $users = User::paginate(5); // Paginate the users with 5 users per page
        return view('users.index', compact('users'));
    }

    public function destroy($id)
    {
        // Perform any additional checks here if needed, e.g., admin validation

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }
}

