<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResetToken;


class CodeCheckController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'token' => 'required|string|exists:reset_code_passwords',
            'email' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $token = PasswordResetToken::firstWhere('token', $request->token);


        // check if it does not expired: the time is one hour
        if ($token->created_at > now()->addHour()) {
            $token->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email 
        $user = User::firstWhere('email', $token->email);

        // update user password
        $user->update($request->only('password'));

        // delete current code 
        $token->delete();

        return response(['message' =>'password has been successfully reset'], 200);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('welcome', ['token' => $token, 'email' => $request->email]);
    }
}
