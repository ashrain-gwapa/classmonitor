<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the main administration dashboard panel with stats.
     */
    public function dashboard()
    {
        // 1. Count users based on their assigned system role metrics
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty  = User::where('role', 'faculty')->count();
        
        // 2. Fetch all laboratory data records sent by faculty to monitor or manage
        $laboratories = Laboratory::with('faculty')->latest()->get();

        return view('admin.dashboard', compact('totalStudents', 'totalFaculty', 'laboratories'));
    }

    /**
     * Render the password change form view interface for the admin.
     */
    public function editPassword()
    {
        return view('admin.change-password');
    }

    /**
     * Handle request data validation and secure field saving for admin password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('The entered current password does not match our records.');
                }
            }],
            'new_password' => 'required|string|min:8|confirmed', // Must match 'new_password_confirmation' field
        ]);

        // Securely hash and save the new credentials
        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Your Admin Account password has been updated securely!');
    }

    /**
     * Show the form for editing a specific laboratory room record.
     */
    public function editLab($id)
    {
        $lab = Laboratory::findOrFail($id);
        $faculties = User::where('role', 'faculty')->get(); // Fetch faculty to re-assign if needed
        return view('admin.edit-lab', compact('lab', 'faculties'));
    }

    /**
     * Update the specified laboratory room record in storage.
     */
    public function updateLab(Request $request, $id)
    {
        $lab = Laboratory::findOrFail($id);
        
        $request->validate([
            'lab_name' => 'required|string|max:255',
            'section_name' => 'nullable|string|max:255',
            'status' => 'required|in:Available,Occupied',
        ]);

        $lab->update([
            'lab_name' => $request->lab_name,
            'section_name' => $request->section_name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Laboratory record updated successfully!');
    }

    /**
     * Remove the specified laboratory room entry from storage.
     */
    public function destroyLab($id)
    {
        $lab = Laboratory::findOrFail($id);
        $lab->delete();

        return redirect()->route('admin.dashboard')->with('with', 'Laboratory entry deleted successfully!');
    }
}