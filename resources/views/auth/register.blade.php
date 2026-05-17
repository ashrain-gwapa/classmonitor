<x-guest-layout>
    <div class="min-h-screen w-full bg-slate-50 flex flex-col justify-center items-center px-4 py-12 antialiased font-sans">
        
        <div class="w-full max-w-[480px] bg-white p-8 sm:p-10 rounded-2xl shadow-xl shadow-slate-200/80 border border-slate-100 space-y-6">
            
            <div class="flex flex-col items-center text-center space-y-2.5">
                <div class="bg-blue-600 p-2.5 rounded-xl text-white inline-block shadow-lg shadow-blue-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900">ClassMonitor <span class="text-blue-600">System</span></h2>
                <p class="text-xs text-slate-500 font-medium max-w-xs">Please choose your role and provide your academic credentials.</p>
            </div>

            <div class="grid grid-cols-2 gap-2 p-1 bg-slate-100 rounded-xl border border-slate-200/60">
                <a href="?role=student" 
                   class="text-center text-xs font-bold py-2.5 rounded-lg transition duration-150 {{ request('role', 'student') === 'student' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                   🎓 Student Form
                </a>
                <a href="?role=faculty" 
                   class="text-center text-xs font-bold py-2.5 rounded-lg transition duration-150 {{ request('role') === 'faculty' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                   👨‍🏫 Faculty Form
                </a>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4.5">
                @csrf

                <input type="hidden" name="role" value="{{ request('role', 'student') }}">

                <div class="space-y-1.5">
                    <label for="name" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">Full Name</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition duration-150"
                        placeholder="{{ request('role') === 'faculty' ? 'Prof. Jane Doe' : 'Juan Dela Cruz' }}">
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-rose-500 font-medium" />
                </div>

                <div class="space-y-1.5">
                    <label for="email" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">Email Address</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition duration-150"
                        placeholder="username@gmail.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-500 font-medium" />
                </div>

                <div class="space-y-1.5">
                    <label for="school_id" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">
                        {{ request('role') === 'faculty' ? 'Faculty Employee ID' : 'Student ID Number' }}
                    </label>
                    <input id="school_id" type="text" name="school_id" :value="old('school_id')" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition duration-150"
                        placeholder="{{ request('role') === 'faculty' ? 'e.g., PROF-456' : 'e.g., CICT-123' }}">
                    <x-input-error :messages="$errors->get('school_id')" class="mt-1 text-xs text-rose-500 font-medium" />
                </div>

                <div class="space-y-1.5">
                    <label for="password" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition duration-150"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-rose-500 font-medium" />
                </div>

                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition duration-150"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-rose-500 font-medium" />
                </div>

                <div class="pt-3 space-y-3.5">
                    <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl shadow-md shadow-blue-500/10 transition duration-150 cursor-pointer text-sm tracking-wide text-center uppercase">
                        Register as {{ request('role', 'student') }}
                    </button>

                    <div class="pt-2 border-t border-slate-100 space-y-2">
                        <button type="button" id="linkPhoneBtn"
                            class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-4 rounded-xl shadow-sm flex items-center justify-center gap-2 text-xs transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                            Verify Identity via Cellphone (Passkey)
                        </button>
                        <p id="passkeyStatus" class="text-center text-[11px] font-medium text-slate-500 hidden"></p>
                    </div>
                    
                    <div class="text-center pt-1">
                        <a class="text-xs font-semibold text-slate-500 hover:text-blue-600 transition duration-150" href="{{ route('login') }}">
                            Already registered? <span class="text-blue-600 underline">Log in here</span>
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script type="module">
        import { Passkeys } from "@laravel/passkeys";

        document.getElementById('linkPhoneBtn').addEventListener('click', async () => {
            const statusText = document.getElementById('passkeyStatus');
            statusText.classList.remove('hidden');
            statusText.innerText = "🔄 Initializing phone link...";
            statusText.className = "text-center text-[11px] font-medium text-blue-600";

            try {
                // Triggers the native browser/cellphone prompt popup overlay automatically
                await Passkeys.register({ name: "ClassMonitor Device Key" });
                
                statusText.innerText = "🎉 Phone Linked & Verified Successfully!";
                statusText.className = "text-center text-[11px] font-semibold text-emerald-600";
            } catch (error) {
                statusText.innerText = "❌ Connection cancelled or timed out.";
                statusText.className = "text-center text-[11px] font-medium text-rose-500";
                console.error(error);
            }
        });
    </script>
</x-guest-layout>