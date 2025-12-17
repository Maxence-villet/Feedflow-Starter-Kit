<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Organizations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex justify-start">
                <a href="{{ route('organizations.create') }}" class="inline-flex items-center px-6 py-3 border font-medium rounded-md shadow-sm gap-3">
                    <svg class="w-5 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add New Organization
                </a>
            </div>

            @if ($organizations->isEmpty())
                <div class="p-6 bg-white">
                    <div class="text-xl text-gray-500 py-12">
                        No organizations for the moment.
                    </div>
                </div>
            @else
                <div class="flex flex-col gap-4">
                    @foreach ($organizations as $organization)
                        <div class="bg-white p-4 shadow-lg sm:rounded-lg transition duration-300 ease-in-out hover:shadow-2xl hover:border-indigo-500 border border-transparent group">
                            
                            <a href="{{ route('organizations.detail', $organization) }}" class="p-5 sm:p-6 pb-2">
                                <h3 class="text-xl font-bold text-gray-800 mb-1">
                                    {{ $organization->name }}
                                </h3>
                                
                                <p class="text-sm text-gray-500 mt-2 flex gap-3">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Created on: {{ $organization->created_at->format('M d, Y') }}
                                </p>
                            </a>
                            
                            <div class="p-4 sm:px-6 pt-2 border-t border-gray-200 bg-gray-50 flex gap-3 justify-end items-center space-x-3">
                                
                                <a href="{{ route('organizations.edit', $organization) }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900 transition flex items-center h-full">
                                    Modifier
                                </a>
                                
                                <form action="{{ route('organizations.destroy', $organization) }}" method="POST" onsubmit="return confirm('Do you really want to delete this organization?')" class="flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-800 transition p-0 m-0 border-none bg-transparent">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>
    </div>
</x-app-layout>