<x-app-layout>
    <div class="py-8 bg-[#f8fafc] min-h-screen font-sans antialiased">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 rounded-3xl p-6 sm:p-8 shadow-xl shadow-blue-500/10 overflow-hidden text-white">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute right-20 -bottom-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-xl"></div>
                
                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="space-y-2">
                        <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
                            ✨ Faculty System Portal Active
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                            @if(auth()->user()->role === 'admin')
                                Welcome Back, Workspace Admin!
                            @else
                                Faculty Overview Dashboard
                            @endif
                        </h1>
                        <p class="text-xs sm:text-sm text-blue-100 max-w-xl font-medium leading-relaxed">
                            Monitor scheduled room utilization schedules, manage sections, and review active laboratory assignments across your department in real-time.
                        </p>
                    </div>
                    
                    @if(auth()->user()->role === 'faculty' || auth()->user()->role === 'admin')
                        <div class="shrink-0">
                            <a href="{{ route('faculty.panel') }}" class="inline-flex items-center gap-2 bg-white text-blue-600 hover:text-blue-700 px-4 py-2.5 rounded-xl hover:bg-blue-50 transition duration-150 shadow-md font-bold text-xs whitespace-nowrap">
                                ⚙️ Go to Management Panel
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Labs</p>
                        <p class="text-lg font-bold text-slate-800">{{ $laboratories ? $laboratories->count() : 0 }} Rooms</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Occupied</p>
                        <p class="text-lg font-bold text-slate-800">{{ $laboratories ? $laboratories->where('status', 'Occupied')->count() : 0 }} Rooms</p>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-4">
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Available</p>
                        <p class="text-lg font-bold text-slate-800">{{ $laboratories ? $laboratories->where('status', 'Available')->count() : 0 }} Rooms</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col sm:flex-row gap-3 items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    <h2 class="text-sm font-bold text-slate-800 tracking-tight">Laboratory Status Monitor</h2>
                </div>
                
                <form method="GET" action="{{ route('faculty.dashboard') }}" class="w-full sm:w-auto flex items-center gap-2">
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" /></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Lab or Section..." 
                            class="w-full bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-700 placeholder-slate-400 focus:outline-none transition duration-150">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md shadow-blue-500/10 transition duration-150 cursor-pointer">
                        Search
                    </button>
                    
                    @if(request('search'))
                        <a href="{{ route('faculty.dashboard') }}" class="bg-slate-100 text-slate-600 hover:bg-slate-200 text-xs font-bold px-4 py-2 rounded-xl transition duration-150 flex items-center justify-center">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($laboratories as $lab)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-md shadow-slate-200/40 overflow-hidden flex flex-col group hover:shadow-lg transition duration-200">
                        <div class="p-5 flex-1 space-y-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-base font-extrabold text-slate-900 tracking-tight group-hover:text-blue-600 transition">
                                        {{ $lab->lab_name }}
                                    </h3>
                                    <div class="flex items-center gap-1.5 mt-1 text-slate-500">
                                        <span class="text-xs font-semibold bg-slate-100 text-slate-700 px-2 py-0.5 rounded-md">Section:</span>
                                        <span class="text-xs font-bold text-slate-800">{{ $lab->section_name ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                
                                @if($lab->status === 'Occupied')
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-100 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span> Occupied
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-100 px-2.5 py-1 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Available
                                    </span>
                                @endif
                            </div>
                            
                            <div class="pt-3 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-400 font-medium">
                                <span class="flex items-center gap-1">⏱️ Updated {{ $lab->updated_at ? $lab->updated_at->diffForHumans() : 'Recently' }}</span>
                                <span class="font-semibold text-slate-600 bg-slate-50 px-2 py-0.5 rounded">Lab Monitor</span>
                            </div>
                        </div>
                        
                        <div class="bg-slate-50/80 px-5 py-3 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-slate-700">
                            <span>👨‍🏫 Handled By:</span>
                            <span class="text-blue-600 hover:underline cursor-pointer">
                                {{ $lab->faculty ? $lab->faculty->name : 'No Instructor Assigned' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-200 shadow-sm">
                        <div class="text-4xl mb-3">🔍</div>
                        <h3 class="text-sm font-bold text-slate-800">No Laboratories Found</h3>
                        <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">We couldn't find any rooms or sections matching your search phrase: "{{ request('search') ?? 'None Entered' }}".</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>