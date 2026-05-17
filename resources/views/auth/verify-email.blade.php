<x-guest-layout>
    <div class="min-h-screen w-full bg-slate-50 flex flex-col justify-center items-center px-4 py-12 antialiased font-sans">
        
        <div class="w-full max-w-[420px] bg-white p-8 sm:p-10 rounded-2xl shadow-xl shadow-slate-200/80 border border-slate-100 space-y-6 text-center">
            
            <div class="mx-auto bg-blue-50 text-blue-600 p-3.5 rounded-full inline-block border border-blue-100 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </div>

            <div class="space-y-1.5">
                <h2 class="text-xl font-bold tracking-tight text-slate-900">Enter Verification Code</h2>
                <p class="text-xs text-slate-500 leading-relaxed px-4">
                    Check your email inbox on your cellphone, copy the **6-digit code**, and type it right below.
                </p>
            </div>

            <form method="POST" action="/verify-code" class="space-y-5">
                @csrf

                @if(session('error'))
                    <div class="text-xs font-semibold text-rose-500 bg-rose-50 border border-rose-100 p-2.5 rounded-xl">
                        {{ session('error') }}
                    </div>
                @endif

                <div>
                    <input type="text" name="code" required maxlength="6" autocomplete="off"
                        class="w-full tracking-[1em] text-center font-mono text-2xl font-bold bg-slate-50 border border-slate-200 rounded-xl px-4 py-3.5 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition"
                        placeholder="000000">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl shadow-md text-sm transition cursor-pointer">
                    Verify Code & Access Dashboard
                </button>
            </form>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="font-bold text-blue-600 hover:underline cursor-pointer">
                        Resend New Code
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-semibold text-slate-400 hover:text-rose-500 underline cursor-pointer">
                        Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>