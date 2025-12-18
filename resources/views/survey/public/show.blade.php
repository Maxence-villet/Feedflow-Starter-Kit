<!DOCTYPE html>
<html>
<head>
    <title>Sondage : {{ $survey->title }}</title>
</head>
<body>
    <h1>Sondage</h1>

    <div style="border: 1px solid #ccc; padding: 15px; background-color: #f9f9f9;">
        <h2>{{ $survey->title }}</h2>
        <p><strong>Description:</strong> {{ $survey->description }}</p>
        <p>
            Veuillez répondre aux questions
        </p>
        <p style="color: red;">
            Ce formulaire est actuellement vide.
        </p>
        
        <form method="POST" action="">
            <button type="submit" style="padding: 10px 20px; background-color: green; color: white; border: none; cursor: pointer; margin-top: 15px;">
                Soumettre les réponses
            </button>
        </form>
    </div>

    <hr>
    <small>ID du Sondage: {{ $survey->id }}</small>
</body>
</html>