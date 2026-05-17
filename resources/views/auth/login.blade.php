<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ClassMonitor System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f8fafc;
        }
        .sakto-card {
            width: 100% !important;
            max-width: 360px !important; /* Forces the exact size of your registration form */
            margin: 0 auto;
        }
    </style>
</head>
<body class="bg-slate-50 antialiased">

    <div class="min-h-screen w-full flex flex-col justify-center items-center px-4 py-8">
        
        <div class="sakto-card bg-white p-6 sm:p-7 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 space-y-4">
            
            <div class="flex flex-col items-center text-center space-y-1.5">
                <div class="bg-blue-600 p-2 rounded-xl text-white inline-block shadow-md shadow-blue-500/10">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <h2 class="text-[17px] font-bold tracking-tight text-slate-900">ClassMonitor System</h2>
                <p class="text-[11px] text-slate-500 font-medium leading-normal max-w-[245px]">Welcome back! Please enter your academic credentials.</p>
            </div>

            @if (session('status'))
                <div class="text-[11px] font-semibold text-emerald-600 bg-emerald-50 border border-emerald-100 p-2 rounded-xl text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-3">
                @csrf

                <div class="space-y-1">
                    <label for="email" class="block text-[11px] font-bold text-slate-800 uppercase tracking-normal">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition duration-150"
                        placeholder="username@gmail.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-0.5 text-[11px] text-rose-500 font-medium" />
                </div>

                <div class="space-y-1">
                    <label for="password" class="block text-[11px] font-bold text-slate-800 uppercase tracking-normal">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition duration-150"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-0.5 text-[11px] text-rose-500 font-medium" />
                </div>

                <div class="flex items-center pt-0.5">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" name="remember" 
                            class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500/5 w-3.5 h-3.5 transition cursor-pointer">
                        <span class="ms-2 text-[11px] font-semibold text-slate-500 hover:text-slate-700 transition">Keep me signed in</span>
                    </label>
                </div>

                <div class="pt-1.5 space-y-3">
                    <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl shadow-sm text-xs tracking-wide uppercase transition duration-150 cursor-pointer">
                        Log In Account
                    </button>
                    
                    <div class="pt-2.5 border-t border-slate-100 flex flex-col items-center gap-1 text-center">
                        <a class="text-[11px] font-semibold text-slate-500 hover:text-blue-600 transition" href="{{ route('register') }}">
                            New to ClassMonitor? <span class="text-blue-600 underline font-bold">Create an account here</span>
                        </a>
                        
                        @if (Route::has('password.request'))
                            <a class="text-[10px] font-medium text-slate-400 hover:text-rose-500 hover:underline transition tracking-tight" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>
</html>