<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Faculty Management Panel</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">Laboratory</th>
                            <th class="p-3">Current Status</th>
                            <th class="p-3">Assigned Section</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laboratories as $lab)
                        <tr class="border-b">
                            <td class="p-3 font-bold">{{ $lab->lab_name }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded {{ $lab->status === 'Available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $lab->status }}
                                </span>
                            </td>
                            <td class="p-3">
                                <form action="{{ route('lab.update', $lab->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="section_name" placeholder="Enter Section" 
                                           value="{{ $lab->section_name }}"
                                           class="border-gray-300 rounded-md text-sm">
                            </td>
                            <td class="p-3">
                                    <select name="status" class="text-sm border-gray-300 rounded-md">
                                        <option value="Available" {{ $lab->status == 'Available' ? 'selected' : '' }}>Set Available</option>
                                        <option value="Occupied" {{ $lab->status == 'Occupied' ? 'selected' : '' }}>Set Occupied</option>
                                    </select>
                                    <button type="submit" class="ml-2 bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>