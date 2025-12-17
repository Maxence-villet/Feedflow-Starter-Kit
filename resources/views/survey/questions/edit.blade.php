<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Modifier la question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('survey.questions.update', $surveyQuestion) }}" method="POST">
                    <a href="{{ route('survey.questions.index', $surveyQuestion->survey) }}">Back to Questions</a>
                </form>

                @if($errors->any())
                    <div style="color: red; margin: 10px 0;">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('survey.questions.update', $surveyQuestion) }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">

                    <div style="margin-bottom: 10px;">
                        <label for="title">Titre de la question:</label><br>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $surveyQuestion->title) }}"
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
                            disabled
                        >
                            <option value="">Sélectionnez un type</option>
                            <option value="text" {{ $surveyQuestion->question_type == 'text' ? 'selected' : '' }}>
                                Texte libre
                            </option>
                            <option value="radio" {{ $surveyQuestion->question_type == 'radio' ? 'selected' : '' }}>
                                Choix unique (radio)
                            </option>
                            <option value="checkbox" {{ $surveyQuestion->question_type == 'checkbox' ? 'selected' : '' }}>
                                Choix multiple (checkbox)
                            </option>
                            <option value="scale" {{ $surveyQuestion->question_type == 'scale' ? 'selected' : '' }}>
                                Échelle de 1 à 10
                            </option>
                        </select><br>
                        <small>Le type de question ne peut pas être modifié après création.</small>
                    </div>

                    @if(in_array($surveyQuestion->question_type, ['radio', 'checkbox']))
                    <div style="margin-bottom: 10px;">
                        <label for="options">Options (une par ligne):</label><br>
                        <textarea
                            id="options"
                            name="options"
                            rows="5"
                            style="width: 400px;"
                            required
                        >{{ old('options', $surveyQuestion->options ? implode("\n", $surveyQuestion->options) : '') }}</textarea>
                    </div>
                    @endif

                    @if($surveyQuestion->question_type === 'scale')
                    <div style="margin-bottom: 10px;">
                        <div style="background: #e3f2fd; border: 1px solid #bbdefb; padding: 10px;">
                            Pour l'échelle 1-10, les options sont générées automatiquement.
                        </div>
                    </div>
                    @endif

                    <div style="margin-top: 20px;">
                        <button type="submit">Modifier la question</button>
                        <a href="{{ route('survey.questions.index', $surveyQuestion->survey) }}" style="margin-left: 10px;">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
