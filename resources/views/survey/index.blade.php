<!DOCTYPE html>
<html>
<head>
    <title>Surveys</title>
</head>
<body>
    <h1>Surveys List</h1>

    <a href="{{ route('survey.create') }}">Create New Survey</a>

    @if(session('success'))
        <div style="color: green; margin: 10px 0;">
            {{ session('success') }}
        </div>
    @endif

    @if($survey->isEmpty())
        <p>No surveys found.</p>
    @else
        <table border="1" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Anonymous</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($survey as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->end_date }}</td>
                        <td>{{ $item->is_anonymous ? 'Yes' : 'No' }}</td>
                        <td>{{ $item->organization_id }}</td>
                        <td>
                            <a href="{{ route('survey.detail', $item) }}">View</a>
                            <a href="{{ route('survey.edit', $item) }}">Edit</a>
                            <form
                                action="{{ route('survey.destroy', $item) }}"
                                method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                            <form 
                                action="{{ route('survey.answers.store', $item) }}" 
                                method="POST" 
                                style="display: inline;"
                            >
                                @csrf
                                <button type="submit">
                                    {{ $item->notification ? 'Disable' : 'Enable' }} Notifications
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('dashboard') }}">Back to Dashboard</a>
    </div>
</body>
</html>
