<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    <h1 class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
        Liste des organisations
    </h1>

    <a href="{{ route('organizations.create') }}">Ajouter une nouvelle organisation</a>

    @if ($organizations->isEmpty())
            <div class="empty-message">
                Aucune organisation n'a été trouvée pour le moment.
            </div>
    @else
        <ul>
            @foreach ($organizations as $organization)
                <li>
                    <h2>{{ $organization->name }}</h2>
                    <p>{{ $organization->created_at->format('d/m/Y') }}</p>
                    <form action="{{ route('organizations.destroy', $organization) }}" method="POST"
                        class="btn btn-danger btn-sm">
                        @csrf
                        @method('DELETE')
                        <button type="submit">X</button>
                        <a href="{{ route('organizations.edit', $organization) }}">Modifiez</a>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>
