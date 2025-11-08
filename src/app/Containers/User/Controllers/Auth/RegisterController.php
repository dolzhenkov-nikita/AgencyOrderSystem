<?php

namespace App\Containers\User\Controllers\Auth;

use App\Containers\User\Models\User;
use App\Containers\User\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token,
        ], 201);

    }
}
