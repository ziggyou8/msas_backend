<!DOCTYPE html>
<html>
<head>
    <title>Ministère de la santé et de l'action sociale</title>
</head>
<body>
    <div class="border">
        <p>Compte sur la plateforme MSAS</p>
        <p>Bonjour <strong>{{ $details['full_name'] }}</strong>,</p>
        <p>
            Vous êtes désigné comme point focal pour la structure {{ $details['structure_name'] }}
        </p>
        <p>sur la <strong>plateforme du ministère de la santé et de l'action sociale</strong>.</p>
        <p> Ci-aprés vos accés:</p>
        <p> <strong>email :</strong> {{ $details['email'] }}</p>
        <p> <strong>password :</strong> {{ $details['password'] }}</p>

        <p>Merci de nous contecter si toutefois vous avez des problèmes pour vous connecter</p>
        <p>Cordialement!</p>
    </div>
</body>
</html>