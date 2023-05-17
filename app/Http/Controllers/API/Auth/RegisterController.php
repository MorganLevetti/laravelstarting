<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Verify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;


class RegisterController extends Controller
{
    public function register(Request $request)
{
    $user = User::firstOrCreate(
        ['email' => $request['email']],
        [
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]
    );

    if (!$user->wasRecentlyCreated) {
        return response()->json([
            'message' => "L'utilisateur existe déja"
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;
    Mail::to ($request['email'])->send (new Verify($request->except ('_token'), $token));
    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'expiration' => config('sanctum.expiration', 60 * 24 * 7),
    ]);
}
    public function verifyEmail(Request $request){
        $token = $request['token'];
        $accessToken = PersonalAccessToken::findToken($token);
        $userVerif = $accessToken->tokenable;
        $user = User::where('email', $userVerif->email)->firstOrFail();
        $user->email_verified_at = Carbon::now();
        $user->save();
        $accessToken->delete ();
        return redirect (config ('app.constants.URL_FRONT')."/login");
    }
}
