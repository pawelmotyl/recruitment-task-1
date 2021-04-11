<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = User::find(Auth::id());
            $token = $user->createToken('Token Name')->accessToken;

            return response()->json([
                'token' => $token
            ]);
        }
    }
}
