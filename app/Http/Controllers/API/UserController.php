<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function profile(Request $request){
        $token = $request['token'];
          if ($token){
              $accessToken = PersonalAccessToken::findToken($token);
              if ($accessToken){
                  $user = $accessToken->tokenable;
                  $user = User::where('email', $user->email)->firstOrFail();
                  return response ()->json ($user);
              }else{
                  return response ()->json (['erreur'=> "Vous n'ètes pas autorisé à être ici"], 401);
              }
          }else{
              return response ()->json (['erreur'=> "Vous n'ètes pas autorisé à être ici"], 401);
          }
        }
}
