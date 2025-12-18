<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Surveys List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <a href="{{ route('survey.create') }}" class="text-gray-800 underline">Create New Survey</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 text-gray-500">
                        {{ session('success') }}
                    </div>
                @endif

                @if($survey->isEmpty())
                    <p class="text-gray-500">No surveys found.</p>
                @else
                    <table class="w-full border-collapse border border-gray-500 text-left align-middle">
                        <thead>
                            <tr class="border-b border-gray-500">
                                <th class="py-2 text-gray-800">Title</th>
                                <th class="py-2 text-gray-800">Start Date</th>
                                <th class="py-2 text-gray-800">End Date</th>
                                <th class="py-2 text-gray-800">Anonymous</th>
                                <th class="py-2 text-gray-800">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($survey as $item)
                                <tr class="border-b border-gray-500">
                                    <td class="py-3 text-gray-800">{{ $item->title }}</td>
                                    <td class="py-3 text-gray-500">{{ $item->start_date }}</td>
                                    <td class="py-3 text-gray-500">{{ $item->end_date }}</td>
                                    <td class="py-3 text-gray-500">{{ $item->is_anonymous ? 'Yes' : 'No' }}</td>
                                    <td class="py-3">
                                        <div class="flex gap-4">
                                            <a href="{{ route('survey.detail', $item) }}" class="text-gray-800 underline">View</a>
                                            <a href="{{ route('survey.edit', $item) }}" class="text-gray-500 underline">Edit</a>
                                            <form action="{{ route('survey.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-500 underline">Delete</button>
                                            </form>
                                            <form action="{{ route('survey.notif.swap', $item) }}" method="POST" >
                                                @csrf
                                                <button type="submit" class="text-gray-500 underline">
                                                    {{ $item->notification ? 'Disable Notifications' : 'Enable Notifications' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="mt-6">
                    <a href="{{ route('organizations.index') }}"><- Back to Organizations</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>