<x-app-layout>
    <div class="py-8 bg-[#f8fafc] min-h-screen font-sans antialiased">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3">
                    <a href="{{ route('faculty.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-blue-600 bg-slate-50 hover:bg-blue-50 px-3 py-1.5 rounded-xl transition duration-150">
                        ← Back to Dashboard
                    </a>
                    <h2 class="font-extrabold text-base text-slate-800 tracking-tight">Laboratory Room Entry Form</h2>
                </div>
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Workspace Management Mode
                </div>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-bold rounded-xl shadow-sm flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md shadow-slate-200/40 relative overflow-hidden">
                <div class="absolute top-0 left-0 h-full w-1.5 bg-gradient-to-b from-blue-600 to-indigo-600"></div>
                
                <h3 class="text-sm font-bold text-slate-800 mb-4 tracking-tight flex items-center gap-1.5">
                    ✨ Add New Laboratory Room
                </h3>
                
                <form action="{{ route('lab.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Lab Name</label>
                            <input type="text" name="lab_name" placeholder="e.g. STUDENT LOUNGE" required
                                class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl px-3 py-2 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition duration-150">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Section Name</label>
                            <input type="text" name="section_name" placeholder="e.g. BSIT3C"
                                class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl px-3 py-2 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition duration-150">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Initial Status</label>
                            <select name="status" class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none transition duration-150 appearance-none cursor-pointer">
                                <option value="Available" selected>Available</option>
                                <option value="Occupied">Occupied</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-2 rounded-xl shadow-md shadow-emerald-500/10 transition duration-150 h-[38px] flex items-center justify-center gap-1 cursor-pointer">
                                ➕ Add Lab Room
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md shadow-slate-200/40">
                <h3 class="text-sm font-bold text-slate-800 mb-4 tracking-tight flex items-center gap-1.5">
                    📋 My Submitted Laboratory Rooms
                </h3>
                
                <div class="overflow-hidden border border-slate-100 rounded-xl">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="p-4 w-1/3">Current Room Data</th>
                                <th class="p-4 w-2/3">Actions / Modification Form</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @php $hasOwnLabs = false; @endphp

                            @foreach($laboratories as $lab)
                                {{-- 🔒 Strict account match architecture preserved --}}
                                @if($lab->updated_by_faculty_id == auth()->id())
                                    @php $hasOwnLabs = true; @endphp
                                    <tr class="group hover:bg-slate-50/50 transition duration-150">
                                        <td class="p-4 align-top">
                                            <div class="space-y-3">
                                                <div>
                                                    <div class="font-extrabold text-slate-900 text-base tracking-tight">{{ $lab->lab_name }}</div>
                                                    <div class="flex items-center gap-1.5 mt-1">
                                                        <span class="text-[10px] font-semibold bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded">Section:</span>
                                                        <strong class="text-xs font-bold text-blue-600">{{ $lab->section_name ?? 'None/Available' }}</strong>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-2">
                                                    @if($lab->status === 'Occupied')
                                                        <span class="inline-flex items-center gap-1 text-[9px] font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-100 px-2 py-0.5 rounded-full">
                                                            <span class="w-1 h-1 bg-rose-500 rounded-full"></span> Occupied
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-1 text-[9px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-100 px-2 py-0.5 rounded-full">
                                                            <span class="w-1 h-1 bg-emerald-500 rounded-full"></span> Available
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="text-[10px] inline-flex items-center gap-1 font-bold text-slate-500 bg-slate-100/80 px-2 py-1 rounded-lg">
                                                    👤 Prof: {{ $lab->faculty->name ?? 'System/Unassigned' }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-4 align-top">
                                            <div class="space-y-4">
                                                <form action="{{ route('lab.update', $lab->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                                                        <div>
                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Lab Name</label>
                                                            <input type="text" name="lab_name" value="{{ $lab->lab_name }}" required
                                                                class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl px-3 py-1.5 text-xs text-slate-700 focus:outline-none transition duration-150">
                                                        </div>

                                                        <div>
                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Section Name</label>
                                                            <input type="text" name="section_name" value="{{ $lab->section_name }}" placeholder="e.g. BSIT3C"
                                                                class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl px-3 py-1.5 text-xs text-slate-700 focus:outline-none transition duration-150">
                                                        </div>
                                                    </div>

                                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-1">
                                                        <div class="w-full sm:w-1/2">
                                                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Room Status</label>
                                                            <select name="status" class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl px-3 py-1.5 text-xs text-slate-700 focus:outline-none transition duration-150 cursor-pointer">
                                                                <option value="Available" {{ $lab->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                                <option value="Occupied" {{ $lab->status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="flex items-center gap-2 pt-4 w-full sm:w-auto justify-end">
                                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-1.5 rounded-xl shadow-md shadow-blue-500/10 transition duration-150 cursor-pointer">
                                                                Update
                                                            </button>
                                                </form> {{-- Outer validation block matching logic explicitly ends here --}}

                                                            <form action="{{ route('lab.destroy', $lab->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this laboratory?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs font-bold px-4 py-1.5 rounded-xl transition duration-150 cursor-pointer">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                            @if(!$hasOwnLabs)
                                <tr>
                                    <td colspan="2" class="p-12 text-center text-slate-400 text-xs font-medium">
                                        <div class="text-3xl mb-2">📁</div>
                                        <p class="font-bold text-slate-700">No Custom Classrooms Submitted</p>
                                        <p class="mt-0.5 text-slate-400">You haven't submitted any laboratory forms yet. Use the form tool component layout above to add one!</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>