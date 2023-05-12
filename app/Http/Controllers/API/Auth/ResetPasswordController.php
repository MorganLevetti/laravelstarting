<?php

namespace App\Http\Controllers\API\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;


class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        // Il faut check ça, je suis pas sur de ça.
        return redirect('http://localhost:3000/resetPassword?token='.$token);
    }

    //  Ici le soucis c'est que le password ne change pas et en retour API j'ai une erreur avec le TOKEN
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);
        
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
        
        $response = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        });
        dd($credentials);
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Password reset successfully');
        } else {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }
        
    }
}