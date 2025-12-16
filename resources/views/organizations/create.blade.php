<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
    Créer une nouvelle organisation
</p>

<form action="{{ route('organizations.store') }}" method="POST">
    @csrf

    <div>
        <label for="title">Nom de l'organisation :</label>
        <input type="text" id="title" name="name" required>
    </div>

    <button type="submit">Créer une organisation</button>
</form>

</body>
</html>
