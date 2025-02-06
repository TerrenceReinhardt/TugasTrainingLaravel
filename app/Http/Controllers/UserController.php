<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Display the UMS Management System (list of users)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Add a new user (for create.blade.php & Node.js)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Ensure default password is set
        $validatedData['password'] = bcrypt('defaultpassword123');

        try {
            $user = User::create($validatedData);
            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Display form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Update an existing user if email exists
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update($validatedData);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
