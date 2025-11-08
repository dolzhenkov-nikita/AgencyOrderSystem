<?php

namespace App\Containers\User\Controllers\Auth;

use App\Containers\User\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                "message" => "Invalid credentials"
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token,
        ]);
    }
}
