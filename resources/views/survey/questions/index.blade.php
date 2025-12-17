<!DOCTYPE html>
<html>
<head>
    <title>Liste des Sondages</title>
</head>
<body>
    <h1>Liste des Sondages</h1>

    <a href="{{ route('survey.create') }}">Créer un nouveau sondage</a>

    @if(session('success'))
        <div style="color: green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    @if($survey->isEmpty())
        <p>Aucun sondage trouvé.</p>
    @else
        <table border="1" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Anonyme</th>
                    <th>Organisation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($survey as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->end_date }}</td>
                        <td>{{ $item->is_anonymous ? 'Oui' : 'Non' }}</td>
                        <td>{{ $item->organization_id }}</td>
                        <td>
                            <a href="{{ route('survey.questions.index', $item) }}">Voir</a>
                            <a href="{{ route('survey.edit', $item) }}">Modifier</a>
                            <a href="{{ route('survey.questions.create', $item) }}">Ajouter question</a>
                            <form
                                action="{{ route('survey.destroy', $item) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Êtes-vous sûr ?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('dashboard') }}">Retour au tableau de bord</a>
    </div>
</body>
</html>
