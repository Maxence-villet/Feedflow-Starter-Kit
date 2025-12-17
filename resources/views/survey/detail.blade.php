<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Details Survey') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">

                    <a href="{{ route('survey.index') }}"><- Back to the List</a>

                    @if(session('success'))
                        <div style="color: green; margin: 10px 0;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div style="margin: 20px 0;">
                        <h2>Survey Information</h2>
                        <p><strong>Description:</strong> {{ $survey->description }}</p>
                        <p><strong>Start Date:</strong> {{ $survey->start_date }}</p>
                        <p><strong>End Date:</strong> {{ $survey->end_date }}</p>
                        <p><strong>Anonymous:</strong> {{ $survey->is_anonymous ? 'Yes' : 'No' }}</p>
                    </div>

                    <div style="margin-top: 20px;">
                        <a href="{{ route('survey.edit', $survey) }}">Modify Survey</a>
                        <a href="{{ route('survey.questions.create', $survey) }}" class="text-green-600" style="margin-left: 10px;">
                            Add a question
                        </a>
                        <form
                            action="{{ route('survey.destroy', $survey) }}"
                            method="POST"
                            style="display: inline; margin-left: 10px;"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sondage ?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete Survey</button>
                        </form>
                    </div>

                    <hr style="margin: 30px 0;">

                    <h2 class="mb-4">Survey Questions :</h2>

                    @if($survey->questions->isEmpty())
                        <p class="mb-4">No questions yet.</p>
                        <button class="border border-gray-300 rounded px-4 py-2">
                            <a href="{{ route('survey.questions.create', $survey) }}" >Add the first question +</a>
                        </button>
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
                                                onsubmit="return confirm('Delete this question ?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div style="margin-top: 20px;">
                        <a href="{{ route('organizations.index') }}"><- Back to Organizations</a>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>


