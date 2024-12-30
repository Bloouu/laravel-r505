<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Note Saisie</title>
</head>
<body>
    <h1>Bonjour {{ $noteDetails['nom'] }},</h1>
    <p>Une nouvelle note a été saisie :</p>
    <ul>
        <li><strong>Note :</strong> {{ $noteDetails['note'] }}</li>
        <li><strong>Évaluation :</strong> {{ $noteDetails['evaluation'] }}</li>
        <li><strong>Date :</strong> {{ $noteDetails['date'] }}</li>
    </ul>
    <p>Merci,</p>
    <p>L'équipe {{ config('app.name') }}</p>
</body>
</html>
