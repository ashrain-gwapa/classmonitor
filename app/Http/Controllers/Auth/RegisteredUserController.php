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
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate custom input constraints
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'school_id' => ['required', 'string', 'max:50', 'unique:'.User::class],
            'role' => ['required', 'in:student,faculty'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the user account entry
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'school_id' => $request->school_id,
            'role' => $request->role,
            // Students can log in immediately. Faculty must wait for verification default to false.
            'is_verified' => $request->role === 'student' ? true : false, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role status
        if ($user->role === 'faculty') {
            return redirect('/faculty/dashboard');
        }

        return redirect('/dashboard');
    }
}