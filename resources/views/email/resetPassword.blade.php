<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Lien de rénitialisation du mot de passe</h2>
<p>Bonjour {{$email}} cliquez sur le lien ci dessous pour rénitialiser votre mot de passe</p>

<a href="{{config ('app.constants.URL_FRONT')}}/resetPassword?token={{$token}}">Rénitialiser mot de passe</a>
</body>
</html>
