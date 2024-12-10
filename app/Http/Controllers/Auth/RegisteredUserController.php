<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'city' => ['sometimes', 'string', 'max:255'],
            'role' => ['sometimes', 'string', 'in:admin,user'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city ?? null,
            'role' => $request->role ?? 'user',
        ]);

        return response()->json([
            'user' => $user
        ], 201);
    }

    public function index(): JsonResponse
    {
        // Fetch all users
        $users = User::all();

        // Return as JSON response
        return response()->json([
            'users' => $users
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    
     // Get the authenticated user's data.
     
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json(['user' => $user], 200);
    }
}
