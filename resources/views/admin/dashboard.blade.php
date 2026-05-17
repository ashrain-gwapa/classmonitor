<x-app-layout>
    <div class="py-8 bg-[#f4f6f9] min-h-screen font-sans antialiased">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-3xl p-6 sm:p-8 shadow-xl text-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <span class="bg-red-500/20 text-red-300 border border-red-500/30 px-3 py-1 rounded-full text-xs font-bold tracking-wide">
                            🛡️ Core Administration System Active
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mt-2">System Control Overview</h1>
                        <p class="text-xs sm:text-sm text-slate-300 max-w-xl font-medium mt-1">
                            Review registered system accounts, manage active server items, and modify or remove submitted faculty laboratory sessions.
                        </p>
                    </div>
                    
                    <div class="shrink-0">
                        <a href="{{ route('admin.password.edit') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-xl transition duration-150 shadow-md font-bold text-xs whitespace-nowrap">
                            🔑 Change Admin Password
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">🧑‍🎓</div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Registered Students</p>
                        <p class="text-2xl font-black text-slate-800">{{ $totalStudents }} Users</p>
                    </div>
                </div>
                
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-teal-50 rounded-xl text-teal-600">👨‍🏫</div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Active Faculty Members</p>
                        <p class="text-2xl font-black text-slate-800">{{ $totalFaculty }} Users</p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">🖥️</div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Tracked Laboratories</p>
                        <p class="text-2xl font-black text-slate-800">{{ $laboratories->count() }} Rooms</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-xs font-bold shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="text-sm font-bold text-slate-800">Faculty Submitted Live Laboratory Data</h2>
                    <span class="text-xs bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md font-medium">Global Scope</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="p-4">Room Name</th>
                                <th class="p-4">Target Section</th>
                                <th class="p-4">Reporting Faculty Member</th>
                                <th class="p-4">Live Status</th>
                                <th class="p-4">Last Updated</th>
                                <th class="p-4 text-center">Administrative Control Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs text-slate-700 font-medium">
                            @forelse($laboratories as $lab)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="p-4 font-bold text-slate-900">{{ $lab->lab_name }}</td>
                                    <td class="p-4"><span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded text-[11px] font-bold">{{ $lab->section_name ?? 'N/A' }}</span></td>
                                    <td class="p-4 text-blue-600">{{ $lab->faculty ? $lab->faculty->name : 'Unassigned Instructor' }}</td>
                                    <td class="p-4">
                                        @if($lab->status === 'Occupied')
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase bg-rose-50 text-rose-600 border border-rose-100 px-2.5 py-0.5 rounded-full">Occupied</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase bg-emerald-50 text-emerald-600 border border-emerald-100 px-2.5 py-0.5 rounded-full">Available</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-slate-400">{{ $lab->updated_at ? $lab->updated_at->diffForHumans() : 'N/A' }}</td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.lab.edit', $lab->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-3 py-1.5 rounded-lg transition text-[11px]">
                                                ✏️ Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.lab.destroy', $lab->id) }}" method="POST" onsubmit="return confirm('Are you completely sure you want to delete this laboratory room record entries entirely?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-bold px-3 py-1.5 rounded-lg transition text-[11px] cursor-pointer">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-slate-400 italic">
                                        No active data tables submitted by faculty members found in system tables.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>