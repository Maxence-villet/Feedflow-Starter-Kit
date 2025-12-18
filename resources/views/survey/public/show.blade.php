<!DOCTYPE html>
<html>
<head>
    <title>Sondage : {{ $survey->title }}</title>
</head>
<body>
    <h1>Sondage</h1>

    <div>
        <h2>{{ $survey->title }}</h2>
        <p><strong>Description:</strong> {{ $survey->description }}</p>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($survey->questions->count() > 0)
            <form id="surveyForm" action="{{ route('survey.answers.store', $survey->id) }}" method="POST">
                @csrf

                @foreach($survey->questions as $index => $question)
                    <div style="margin-bottom: 20px;">
                        <p><strong>Question {{ $index + 1 }}</strong> {{ $question->title }}</p>

                        @switch($question->question_type)
                            @case('text')
                                <textarea name="answers[{{ $question->id }}]" rows="3"></textarea>
                                @break

                            @case('radio')
                                @if(is_array($question->options))
                                    @foreach($question->options as $option)
                                        <div>
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" id="q{{ $question->id }}_{{ $loop->index }}">
                                            <label for="q{{ $question->id }}_{{ $loop->index }}">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                @endif
                                @break

                            @case('checkbox')
                                @if(is_array($question->options))
                                    <div class="checkbox-group" data-question-id="{{ $question->id }}">
                                        @foreach($question->options as $option)
                                            <div>
                                                <input type="checkbox" value="{{ $option }}" id="c{{ $question->id }}_{{ $loop->index }}">
                                                <label for="c{{ $question->id }}_{{ $loop->index }}">{{ $option }}</label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="answers[{{ $question->id }}]" class="hidden-answer">
                                    </div>
                                @endif
                                @break

                            @case('scale')
                                <div>
                                    <input type="range" name="answers[{{ $question->id }}]" min="1" max="10" step="1" value="5">
                                </div>
                                @break

                            @case('select')
                                @if(is_array($question->options))
                                    <select name="answers[{{ $question->id }}]">
                                        <option value="">Sélectionnez une option</option>
                                        @foreach($question->options as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @break

                            @default
                                <input type="text" name="answers[{{ $question->id }}]">
                        @endswitch

                        @error('answers.' . $question->id)
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <input type="hidden" name="survey_id" value="{{ $survey->id }}">    
                <button type="submit">Soumettre les réponses</button>            
            </form>
        @endif
    </div>

    <script>
        document.getElementById('surveyForm').addEventListener('submit', function(e) {
            const groups = document.querySelectorAll('.checkbox-group');
            
            groups.forEach(group => {
                const checked = group.querySelectorAll('input[type="checkbox"]:checked');
                const hiddenInput = group.querySelector('.hidden-answer');
                
                const values = Array.from(checked).map(cb => cb.value);
                hiddenInput.value = values.join(', ');
            });
        });
    </script>
</body>
</html>