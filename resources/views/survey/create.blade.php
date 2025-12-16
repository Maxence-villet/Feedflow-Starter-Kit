<!DOCTYPE html>
<html>
<head>
    <title>Create Survey</title>
</head>
<body>
    <h1>Create New Survey</h1>
    
    <a href="{{ route('survey.index') }}">Back to List</a>
    
    @if($errors->any())
        <div style="color: red; margin: 10px 0;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('survey.store') }}" method="POST" style="margin-top: 20px;">
        @csrf
        
        <div style="margin-bottom: 10px;">
            <label for="title">Title:</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title') }}"
                required
                style="width: 300px;"
            >
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="description">Description:</label><br>
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                style="width: 300px;"
            >{{ old('description') }}</textarea>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="start_date">Start Date:</label>
            <input 
                type="date" 
                id="start_date" 
                name="start_date" 
                value="{{ old('start_date') }}"
                required
            >
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="end_date">End Date:</label>
            <input 
                type="date" 
                id="end_date" 
                name="end_date" 
                value="{{ old('end_date') }}"
                required
            >
        </div>
        
        <div style="margin-bottom: 10px;">
            <label for="is_anonymous">
                <input 
                    type="checkbox" 
                    id="is_anonymous" 
                    name="is_anonymous" 
                    value="1"
                    {{ old('is_anonymous') ? 'checked' : '' }}
                >
                Anonymous Survey
            </label>
        </div>
        
        <button type="submit">Create Survey</button>
    </form>
</body>
</html>