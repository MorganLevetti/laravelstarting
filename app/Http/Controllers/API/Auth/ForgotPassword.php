<?php

namespace App\Http\Controllers\API\Auth;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Controller
{
    public function sendLink(Request $request){
        $email = $request['email'];
        if ($email){
            $user = User::where('email', $email)->first();
            if ($user){
                $token = $user->createToken('auth_token')->plainTextToken;
                Mail::to ($request['email'])->send (new ResetPassword($email, $token));
                return response ()->json ("ok");
            }
            return response ()->json ($email);
        }else{
            return response ()->json ([
                'Erreur'=>'Email requis'
            ], 401);
        }
    }

    public function resetPassword(Request $request){
        if ($request['token']){
            $accessToken = PersonalAccessToken::findToken($request['token']);
            if ($accessToken){
                $user = $accessToken->tokenable;
                $user = User::where('email', $user->email)->firstOrFail();
                if($user){
                    $user->password = Hash::make($request['password']);
                    $user->save();
                    $accessToken->delete ();
                    return response ()->json ('password change');
                }
            }else{
                return response ()->json ([
                    'Erreur'=>'Access limiter'
                ], 401);
            }
        }else{
            return response ()->json ([
                'Erreur'=>'Access limiter'
            ], 401);
        }
    }
}
