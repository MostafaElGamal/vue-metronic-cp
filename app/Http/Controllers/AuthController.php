<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\User\loginRequest;

class AuthController extends Controller
{
    public function login(loginRequest $request)
    {
        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json(['message' => 'The Email or The Password Wrong'], 401);
        }

        $user = auth()->user();
        if ($user->status == 'active') {
            $accessToken = $user->createToken($user->name)->accessToken;
            $permissions = $user->roles()->firstOrFail()->permissions;
            return response()->json(['user' => auth()->user(), 'access_token' => $accessToken, 'permissions' => $permissions], 200);
        } else {
            return response()->json(['message' => 'You Are not authorized to login'], 401);
        }
    }

    public function logout()
    {
        if (!auth()->user()) {
            return response()->json(['message' => 'Not authorized'], 401);
        }

        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Logged Out', 200);
    }
}
