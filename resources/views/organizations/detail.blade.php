<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organization Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-row justify-between text-gray-900 mb-6">
                    <h2>{{ $organization->name }}</h2>
                    <h2 class="text-gray-500">Created on {{ $organization->created_at->format('M d, Y')}}</h2>
                </div>

                <div x-data="{ showSelect: false }" class="mt-6">
                    <button 
                        type="button"
                        @click="showSelect = !showSelect" 
                        class="bg-gray-500 text-white font-bold py-2 px-4 rounded mb-4 flex items-center flex-row gap-4"
                    >
                        <svg x-show="!showSelect" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <svg x-show="showSelect" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        {{ __('Add User') }}
                    </button>

                    <div x-show="showSelect" x-transition class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <form action="{{ route('organizations.users.store', $organization) }}" method="POST">
                            @csrf
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Select a user to add:</label>
                            
                            <div class="flex flex-col sm:flex-row gap-3">
                                <select 
                                    name="user_id" 
                                    id="user_id" 
                                    class="block w-full sm:w-64 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 p-2.5 text-sm"
                                >
                                    <option value="">-- Chose a user --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})</option>
                                    @endforeach
                                    
                                </select>

                                <select 
                                    name="role" 
                                    id="role" 
                                    class="block w-full sm:w-48 border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500 p-2.5 text-sm"
                                    >
                                    <option value="">-- Chose a Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="member">Member</option>
                                </select>

                                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-black transition">
                                    Confirm Addition
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if($organizationUsers->isEmpty())
                    <p class="text-gray-900">No users found in this organization.</p>
                @else
                    <div class="text-gray-900">
                        <h3 class="text-lg font-medium mb-4">Users in this organization:</h3>
                        <ul class="list-disc pl-5">
                            @foreach($organizationUsers as $user)
                                <li> - {{ $user->first_name }} {{ $user->last_name }} ({{ $user->role }})</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
