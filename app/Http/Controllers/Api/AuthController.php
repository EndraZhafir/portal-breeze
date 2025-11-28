<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
    * @OA\SecurityScheme(
    *   securityScheme="bearerAuth",
    *   type="http",
    *   scheme="bearer"
    * )
    * 
    * @OA\Post(
    *   path="/api/register",
    *   tags={"Authentication"},
    *   summary="Register new user",
    *   @OA\RequestBody(
    *     required=true,
    *     @OA\JsonContent(
    *       required={"name","email","password"},
    *       @OA\Property(property="name", type="string", example="John Doe"),
    *       @OA\Property(property="email", type="string", format="email", example="john@example.com"),
    *       @OA\Property(property="password", type="string", format="password", example="password123")
    *     )
    *   ),
    *   @OA\Response(response=201, description="User registered successfully"),
    *   @OA\Response(response=422, description="Validation error")
    * )
    */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user', // default role job seeker
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"Authentication"},
     *   summary="Login user",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password123")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Login successful"),
     *   @OA\Response(response=401, description="Invalid credentials")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'user' => $user,
        ], 200);
    }

    /**
     * @OA\Post(
     *   path="/api/logout",
     *   tags={"Authentication"},
     *   summary="Logout user",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(response=200, description="Logged out successfully")
     * )
     */
    public function logout(Request $request)
    {
        /**
         * @var \App\Models\User $user
         */
        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
