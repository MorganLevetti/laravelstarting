<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de votre mot de passe</title>
</head>
<body>
    <p>Bonjour,</p>
    <p>Vous avez demandé la réinitialisation de votre mot de passe. Pour procéder, veuillez cliquer sur le lien ci-dessous :</p>
    <p><a href="{{ url('/api/reset_password_email/'.$token) }}">Réinitialiser votre mot de passe</a></p>
    <p>Si vous n'avez pas demandé la réinitialisation de votre mot de passe, ignorez simplement ce message.</p>
    <p>Cordialement,<br>Votre équipe de support</p>
</body>
</html>