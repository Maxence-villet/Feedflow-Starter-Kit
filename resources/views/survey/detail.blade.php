<!DOCTYPE html>
<html>
<head>
    <title>Survey Details</title>
</head>
<body>
    <h1>Survey Details</h1>

    <a href="{{ route('survey.index') }}">Back to List</a>

    @if(session('success'))
        <div style="color: green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin: 20px 0;">
        <h2>{{ $survey->title }}</h2>
        <p><strong>Description:</strong> {{ $survey->description }}</p>
        <p><strong>Start Date:</strong> {{ $survey->start_date }}</p>
        <p><strong>End Date:</strong> {{ $survey->end_date }}</p>
        <p><strong>Organization ID:</strong> {{ $survey->organization_id }}</p>
        <p><strong>Anonymous:</strong> {{ $survey->is_anonymous ? 'Yes' : 'No' }}</p>
        <p><strong>Created:</strong> {{ $survey->created_at }}</p>
        <p><strong>Updated:</strong> {{ $survey->updated_at }}</p>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('survey.edit', $survey) }}">Edit</a>

        <form
            action="{{ route('survey.destroy', $survey) }}"
            method="POST"
            style="display: inline; margin-left: 10px;"
            onsubmit="return confirm('Are you sure?')"
        >
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
</body>
</html>
