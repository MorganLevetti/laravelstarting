<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    public function testTokenData (Request $request){
        $token = $request['token'];
        PersonalAccessToken::findToken ($token)->tokenable ();
    }
}
