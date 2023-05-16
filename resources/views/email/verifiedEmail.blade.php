<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Vérification de votre email</h2>
<p>Bonjour {{$userVerify['name']}} cliquez sur le lien ci dessous pour vérifier votre mail</p>
<ul>
    <li>Voici votre nom : <strong>{{$userVerify['name']}}</strong></li>
    <li>Voici votre nom d'utilisateur : <strong>{{$userVerify['username']}}</strong></li>
    <li>Voici votre email pour vous connecter  : <strong>{{$userVerify['email']}}</strong></li>
</ul>
<a href="{{config ('app.constants.URL_BACK')}}/api/verify?token={{$token}}">Vérifier votre email</a>
</body>
</html>
