<x-app-layout>
    <div class="py-8 bg-[#f4f6f9] min-h-screen font-sans antialiased">
        <div class="max-w-md mx-auto px-4 space-y-6">
            
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-slate-800 transition">
                ← Back to Control Panel Overview
            </a>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-xl overflow-hidden">
                <div class="p-6 bg-slate-900 text-white">
                    <h2 class="text-base font-extrabold">Account Security Settings</h2>
                    <p class="text-xs text-slate-400 mt-1">Update authentication passkeys for your master system profile.</p>
                </div>

                @if ($errors->any())
                    <div class="p-4 bg-rose-50 border-b border-rose-100 text-rose-800 text-xs font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>⚠️ {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('admin.password.update') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Current Account Password</label>
                        <input type="password" name="current_password" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none transition">
                    </div>

                    <hr class="border-slate-100 my-2">

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">New System Password</label>
                        <input type="password" name="new_password" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" required class="w-full bg-slate-50 border border-slate-200 focus:border-blue-500 rounded-xl px-4 py-2 text-xs font-semibold focus:outline-none transition">
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold px-4 py-2 rounded-xl transition">Cancel</a>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-md transition cursor-pointer">Update Passkey</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>