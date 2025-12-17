<!DOCTYPE html>
<html>
<head>
    <title>Détails du Sondage</title>
</head>
<body>
    <h1>{{ $survey->title }}</h1>

    <a href="{{ route('survey.index') }}">Retour à la liste</a>

    @if(session('success'))
        <div style="color: green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin: 20px 0;">
        <h2>Informations du sondage</h2>
        <p><strong>Description:</strong> {{ $survey->description }}</p>
        <p><strong>Date de début:</strong> {{ $survey->start_date }}</p>
        <p><strong>Date de fin:</strong> {{ $survey->end_date }}</p>
        <p><strong>Anonyme:</strong> {{ $survey->is_anonymous ? 'Oui' : 'Non' }}</p>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('survey.edit', $survey) }}">Modifier le sondage</a>
        <a href="{{ route('survey.questions.create', $survey) }}" style="margin-left: 10px;">
            Ajouter une question
        </a>
        <form
            action="{{ route('survey.destroy', $survey) }}"
            method="POST"
            style="display: inline; margin-left: 10px;"
            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sondage ?')"
        >
            @csrf
            @method('DELETE')
            <button type="submit">Supprimer le sondage</button>
        </form>
    </div>

    <hr style="margin: 30px 0;">

    <h2>Questions du sondage</h2>

    @if($survey->questions->isEmpty())
        <p>Aucune question pour le moment.</p>
        <a href="{{ route('survey.questions.create', $survey) }}">Ajouter la première question</a>
    @else
        <table border="1" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Type</th>
                    <th>Options</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($survey->questions as $surveyQuestion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surveyQuestion->title }}</td>
                        <td>
                            @switch($surveyQuestion->question_type)
                                @case('text')
                                    Texte libre
                                    @break
                                @case('radio')
                                    Choix unique
                                    @break
                                @case('checkbox')
                                    Choix multiple
                                    @break
                                @case('scale')
                                    Échelle 1-10
                                    @break
                            @endswitch
                        </td>
                        <td>
                            @if($surveyQuestion->options && !empty($surveyQuestion->options))
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach($surveyQuestion->options as $option)
                                        <li>{{ $option }}</li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('survey.questions.edit', $surveyQuestion) }}">Modifier</a>
                            <form
                                action="{{ route('survey.questions.destroy', $surveyQuestion) }}"
                                method="POST"
                                style="display: inline; margin-left: 10px;"
                                onsubmit="return confirm('Supprimer cette question ?')"
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
