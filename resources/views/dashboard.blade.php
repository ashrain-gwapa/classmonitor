<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4">Laboratory Status Monitor</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="mb-6">
    <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" 
               placeholder="Search Lab or Section..." 
               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
            Search
        </button>
        @if(request('search'))
            <a href="{{ route('dashboard') }}" class="bg-red-500 text-white px-4 py-2 rounded-md">Clear</a>
        @endif
    </form>
</div>
            @foreach($laboratories as $lab)
            <div class="border rounded-lg p-4 {{ $lab->status === 'Available' ? 'bg-green-50' : 'bg-red-50' }}">
                <div class="flex justify-between items-center">
                    <h4 class="font-bold text-xl">{{ $lab->lab_name }}</h4>
                    <span class="px-2 py-1 rounded text-sm {{ $lab->status === 'Available' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                        {{ $lab->status }}
                    </span>
                </div>
                <p class="mt-2 text-gray-600">
                    Section: <span class="font-semibold">{{ $lab->section_name ?? 'N/A' }}</span>
                </p>
                <p class="text-xs text-gray-400 mt-1">Last update: {{ $lab->updated_at->diffForHumans() }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
</x-app-layout>
