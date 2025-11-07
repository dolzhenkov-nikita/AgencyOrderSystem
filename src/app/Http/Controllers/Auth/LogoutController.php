<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;

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
