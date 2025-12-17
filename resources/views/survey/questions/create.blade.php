<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une question</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionType = document.getElementById('question_type');
            const optionsContainer = document.getElementById('options-container');
            const scaleInfo = document.getElementById('scale-info');
            const optionsInput = document.getElementById('options');

            function toggleOptions() {
                const value = questionType.value;

                // Masquer tout d'abord
                optionsContainer.style.display = 'none';
                scaleInfo.style.display = 'none';
                optionsInput.required = false;

                // Afficher selon le type
                if (value === 'radio' || value === 'checkbox') {
                    optionsContainer.style.display = 'block';
                    optionsInput.required = true;
                } else if (value === 'scale') {
                    scaleInfo.style.display = 'block';
                }
            }

            // Écouter les changements
            questionType.addEventListener('change', toggleOptions);

            // Initialiser l'état
            toggleOptions();
        });
    </script>
</head>
<body>
    <h1>Ajouter une question au sondage : {{ $survey->title }}</h1>

    <a href="{{ route('survey.questions.index', $survey) }}">Retour au sondage</a>

    @if($errors->any())
        <div style="color: red; margin: 10px 0;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('survey.questions.store', $survey) }}" method="POST" style="margin-top: 20px;">
        @csrf
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">

        <div style="margin-bottom: 10px;">
            <label for="title">Titre de la question:</label><br>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
                style="width: 400px;"
            >
        </div>

        <div style="margin-bottom: 10px;">
            <label for="question_type">Type de question:</label><br>
            <select
                id="question_type"
                name="question_type"
                required
            >
                <option value="">Sélectionnez un type</option>
                <option value="text" {{ old('question_type') == 'text' ? 'selected' : '' }}>
                    Texte libre
                </option>
                <option value="radio" {{ old('question_type') == 'radio' ? 'selected' : '' }}>
                    Choix unique (radio)
                </option>
                <option value="checkbox" {{ old('question_type') == 'checkbox' ? 'selected' : '' }}>
                    Choix multiple (checkbox)
                </option>
                <option value="scale" {{ old('question_type') == 'scale' ? 'selected' : '' }}>
                    Échelle de 1 à 10
                </option>
            </select>
        </div>

        <div id="options-container" style="margin-bottom: 10px; display: none;">
            <label for="options">Options (une par ligne):</label><br>
            <textarea
                id="options"
                name="options"
                rows="5"
                style="width: 400px;"
            >{{ old('options') }}</textarea><br>
            <small>Saisissez chaque option sur une nouvelle ligne. Exemple:<br>
            Option 1<br>
            Option 2<br>
            Option 3</small>
        </div>

        <div id="scale-info" style="margin-bottom: 10px; display: none;">
            <div style="background: #e3f2fd; border: 1px solid #bbdefb; padding: 10px;">
                Pour l'échelle 1-10, les options seront automatiquement générées.
            </div>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit">Ajouter la question</button>
            <a href="{{ route('survey.questions.index', $survey) }}" style="margin-left: 10px;">Annuler</a>
        </div>
    </form>
</body>
</html>
