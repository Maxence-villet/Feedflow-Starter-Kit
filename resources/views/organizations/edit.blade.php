<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Organization Update') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8 text-gray-900">
                    
                    <h3 class="text-xl font-extrabold mb-6 text-gray-800">
                        Editing: {{ $organization->name }}
                    </h3>

                    <form action="{{ route('organizations.update', $organization) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Organization Name:</label>
                            
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $organization->name) }}"
                                class="mt-1 w-full border border-gray-300 rounded-md shadow-sm sm:text-sm p-5"
                                required
                            >
                            
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100 gap-3">
                            
                            <a href="{{ route('organizations.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition duration-150 ease-in-out">
                                Cancel and return to list
                            </a>
                            
                            <button type="submit" class="text-sm font-medium text-green-600 hover:text-green-900 transition duration-150 ease-in-out">
                                Confirm
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>