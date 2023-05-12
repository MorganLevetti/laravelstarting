<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\SendMailreset;

//  =================== Pour la configuration du mail c'est dans le fichier .env ===================
        // exemple : 
        // 
        // MAIL_MAILER=smtp
        // MAIL_HOST=smtp.office365.com
        // MAIL_PORT=587
        // MAIL_USERNAME=adresse_mail_d'envoi@outlook.fr
        // MAIL_PASSWORD=mdp_adresse_d'envoi
        // MAIL_ENCRYPTION=tls
        // MAIL_FROM_ADDRESS=adresse_mail_d'envoi@outlook.fr
        // MAIL_FROM_NAME="${APP_NAME}"
        // 
        // c'est pour une boite mail outlook ! sur google c'est différent
//  ======================================

class ForgotPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        // Si user est pas dans la bdd alors ne fait rien.
        if ($user == null) 
        {
            $return = response()->json([
                'message' => 'Adresse e-mail non enregistrer',
                'info' => 'not_subscribed'
            ]);
            // error_log($return);
            return $return;
        }else {
            if (DB::table('password_reset_tokens')->where('email', $request->email)->exists()) {
                return response()->json(['message' => 'L\'email est déjà enregistré.'], 400);
            }else{
                // Créer le Token
                $token = Str::random(64);
                // Rentre les champs en bdd sur la table 'password reset tokens'
                DB::table('password_reset_tokens')->insert([
                    'email' => $request->email, 
                    'token' => $token, 
                    'created_at' => Carbon::now()
                ]);
                // Envoyez l'e-mail
                $path = 'http://localhost:3000/resetPassword?token=' . $token;
                Mail::to($email)->send(new SendMailreset($token, $email, $path));
                return response()->json([
                    'message' => 'Un lien de réinitialisation de mot de passe a été envoyé à votre adresse email.'
                ], 200);
            }
            
        }
    }
}
