<?php

namespace App\Http\Controllers\API\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
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
    public function logout(Request $request)
    {
        $token = $request['token'];
        if ($token){
                PersonalAccessToken::findToken ($token)->delete ();
                return response ()->json (['message' => 'Deconnection avec succéss']);
        }
    }

}
