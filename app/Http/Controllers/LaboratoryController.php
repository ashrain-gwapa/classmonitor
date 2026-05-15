<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    // Show the Faculty Dashboard (Gina will build the view later)
    public function facultyIndex()
    {
        $laboratories = Laboratory::all();
        return view('faculty.dashboard', compact('laboratories'));
    }

    // This is the function that actually updates the status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Available,Occupied',
            'section_name' => 'required_if:status,Occupied|nullable|string|max:50',
        ]);

        $lab = Laboratory::findOrFail($id);
        
        $lab->update([
            'status' => $request->status,
            // If status is Available, we clear the section name automatically
            'section_name' => ($request->status === 'Available') ? null : $request->section_name,
            'updated_by_faculty_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Laboratory status updated!');
    }
}