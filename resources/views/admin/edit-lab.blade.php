<x-app-layout>
    <div class="py-8 bg-[#f4f6f9] min-h-screen font-sans antialiased">
        <div class="max-w-2xl mx-auto px-4 space-y-6">
            
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
                ← Back to Administration Overview Dashboard
            </a>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-xl overflow-hidden">
                <div class="p-6 bg-slate-900 text-white">
                    <h2 class="text-base font-extrabold">Modify Faculty Lab Room Properties</h2>
                    <p class="text-xs text-slate-400 mt-1">Make direct administrative changes to database records.</p>
                </div>

                <form action="{{ route('admin.lab.update', $lab->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Laboratory Name</label>
                        <input type="text" name="lab_name" value="{{ old('lab_name', $lab->lab_name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none focus:border-blue-500 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Assigned Academic Class Section Identifier</label>
                        <input type="text" name="section_name" value="{{ old('section_name', $lab->section_name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none focus:border-blue-500 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Assigned Instructor Profile</label>
                        <select name="user_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none focus:border-blue-500 transition">
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}" {{ $lab->user_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Live Deployment Status Field</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none focus:border-blue-500 transition">
                            <option value="Available" {{ $lab->status === 'Available' ? 'selected' : '' }}>🟢 Available</option>
                            <option value="Occupied" {{ $lab->status === 'Occupied' ? 'selected' : '' }}>🔴 Occupied</option>
                        </select>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold px-4 py-2 rounded-xl transition">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md transition cursor-pointer">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>