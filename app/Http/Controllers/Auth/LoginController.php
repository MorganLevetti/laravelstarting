<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    
    public function login(Request $request)
    {
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                ], 401);
           }
    
    $user = User::where('email', $request['email'])->firstOrFail();
    
    $token = $user->createToken('auth_token')->plainTextToken;
    
    return response()->json([
               'access_token' => $token,
               'token_type' => 'Bearer',
               'expiration' => config('sanctum.expiration', 60*24*7)
    ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

}
