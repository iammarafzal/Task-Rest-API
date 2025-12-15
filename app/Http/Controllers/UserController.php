<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new User with Profile and Posts
     */
    public function store(Request $request)
    {
        // 1. Basic Validation (Optional but recommended)
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile.phone' => 'required',
            'posts' => 'array'
        ]);

        // 2. Create the User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Create the Profile (using the 'profile' key from JSON)
        if ($request->has('profile')) {
            $user->profile()->create($request->profile);
        }

        // 4. Create the Posts (using the 'posts' key from JSON)
        // createMany is very efficient for arrays of data
        if ($request->has('posts')) {
            $user->posts()->createMany($request->posts);
        }

        return response()->json([
            'message' => 'User created successfully via JSON payload',
            'user' => $user->load('profile', 'posts') // Return user with data
        ], 201);
    }

    /**
     * Get User Data with Profile and Posts
     */
    public function show($id)
    {
        // Find user and eager load the profile and posts relationships
        $user = User::with(['profile', 'posts'])->findOrFail($id);

        return response()->json($user);
    }
}