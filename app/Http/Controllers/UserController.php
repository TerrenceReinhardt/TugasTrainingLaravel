<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Display the UMS Management System (list of users)
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();
        // Return the view (for example, resources/views/users/index.blade.php)
        // and pass the users collection to it.
        return view('users.index', compact('users'));
    }

    // Add a new user (for create.blade.php & Node.js)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        try {
            $user = User::create($validatedData);
            // Redirect back with a success message
            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('users.create');
    }

    // Update an existing user if email exists
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $validatedData = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
        ]);

        try {
            $user->update($validatedData);
            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}