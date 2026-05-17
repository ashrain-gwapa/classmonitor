<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate the incoming input fields from the form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'school_id' => ['required', 'string', 'max:50', 'unique:'.User::class], 
            'role' => ['required', 'in:student,faculty'], // Restricts form options to student or faculty only
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // SAFE GUARD: Force assignment values to completely prevent admin signup injection spoofing
        $assignedRole = $request->role;
        if ($assignedRole === 'admin') {
            $assignedRole = 'student'; 
        }

        // 2. Create the user database record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'school_id' => $request->school_id, 
            'role' => $assignedRole, // Uses the safe, sanitized role value         
            'is_verified' => 1, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // 🛑 REMOVED: Auth::login($user); <--- Unchanged, keeps user from auto-logging in.

        // 3. Redirect everyone to the login page with a flash message
        return redirect()->route('login')->with('status', 'Registration successful! Please log in to access your account.');
    }
}