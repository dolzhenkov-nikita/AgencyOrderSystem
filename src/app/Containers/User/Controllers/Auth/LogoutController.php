<?php

namespace App\Containers\User\Controllers\Auth;

use App\Containers\User\Requests\Auth\LogoutRequest;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(LogoutRequest $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message"=>"Logged out successfully"
        ]);
    }
}
