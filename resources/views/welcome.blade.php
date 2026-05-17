<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to ClassMonitor System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <header class="w-full max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 text-white p-2 rounded-lg shadow-md shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg>
            </div>
            <span class="text-xl font-bold tracking-tight text-slate-900">ClassMonitor <span class="text-blue-600">System</span></span>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-medium text-slate-600 hover:text-slate-900 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-slate-600 hover:text-slate-900 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm shadow-blue-100 transition duration-200">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main class="w-full max-w-7xl mx-auto px-6 flex-1 flex flex-col lg:flex-row items-center justify-center gap-12 py-12">
        <div class="flex-1 space-y-6 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold tracking-wide">
                ✨ Streamlining Academic Monitoring
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                Manage, Monitor, and Empower <span class="text-blue-600">Your Classroom</span> Experience.
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                A centralized attendance and performance platform designed specifically for students and academic instructors to communicate efficiently.
            </p>
            
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3.5 rounded-xl shadow-lg shadow-blue-200 transition duration-200">
                    Get Started Now
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto text-center bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold px-8 py-3.5 rounded-xl transition duration-200">
                    Account Login
                </a>
            </div>
        </div>

        <div class="flex-1 w-full max-w-md lg:max-w-none flex justify-center">
            <div class="w-full max-w-[450px] bg-slate-900 rounded-3xl p-6 text-slate-100 shadow-2xl border border-slate-800 relative overflow-hidden flex flex-col justify-between">
                
                <div class="flex justify-between items-center border-b border-slate-800 pb-4 mb-4">
                    <div class="flex items-center gap-2">
                        <div class="flex gap-1.5">
                            <span class="w-2.5 h-2.5 bg-rose-500 rounded-full inline-block"></span>
                            <span class="w-2.5 h-2.5 bg-amber-500 rounded-full inline-block"></span>
                            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full inline-block"></span>
                        </div>
                        <span class="text-xs font-semibold text-slate-400 ml-2 tracking-wide">ClassMonitor Application</span>
                    </div>
                    <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">Dashboard View</span>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-5">
                    <div class="bg-slate-800/40 border border-slate-800 rounded-xl p-3">
                        <span class="text-[10px] text-slate-400 font-medium block uppercase tracking-wider">Avg Attendance</span>
                        <div class="flex items-baseline gap-1.5 mt-1">
                            <span class="text-xl font-bold text-white tracking-tight">94.2%</span>
                            <span class="text-[11px] font-bold text-emerald-400">↑ 1.8%</span>
                        </div>
                    </div>
                    <div class="bg-slate-800/40 border border-slate-800 rounded-xl p-3">
                        <span class="text-[10px] text-slate-400 font-medium block uppercase tracking-wider">System Alerts</span>
                        <div class="flex items-baseline gap-1.5 mt-1">
                            <span class="text-xl font-bold text-amber-400 tracking-tight">0 Logs</span>
                            <span class="text-[11px] text-slate-400">Stable</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-2.5 flex-1">
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block mb-1">Your Enrolled Courses</span>
                    
                    <div class="bg-slate-800/80 border border-slate-700/60 rounded-xl p-3 flex justify-between items-center shadow-inner">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 ring-4 ring-blue-500/20"></div>
                            <div>
                                <p class="text-xs font-bold text-white tracking-wide">BSIT 3-C</p>
                                <p class="text-[11px] text-slate-400">Web Development Frameworks</p>
                            </div>
                        </div>
                        <span class="text-[10px] bg-slate-700 text-slate-300 font-semibold px-2 py-0.5 rounded">Active</span>
                    </div>

                    <div class="bg-slate-800/30 border border-slate-800/60 rounded-xl p-3 flex justify-between items-center opacity-60">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-slate-600"></div>
                            <div>
                                <p class="text-xs font-bold text-slate-300 tracking-wide">BSIT 3-A</p>
                                <p class="text-[11px] text-slate-500">Mobile Applications Development</p>
                            </div>
                        </div>
                        <span class="text-[10px] bg-slate-800 text-slate-600 font-semibold px-2 py-0.5 rounded">1:00 PM</span>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-t border-slate-800 flex justify-between items-center text-xs text-slate-500">
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[11px] text-slate-400">Gateway: <span class="text-emerald-400 font-medium">Gmail Connected</span></span>
                    </div>
                    <span class="text-[10px] text-slate-600 font-mono">v1.0.0</span>
                </div>

            </div>
        </div>
    </main>

    <footer class="w-full text-center py-6 text-sm text-slate-400 border-t border-slate-100">
        &copy; {{ date('Y') }} ClassMonitor System. All rights reserved.
    </footer>

</body>
</html>