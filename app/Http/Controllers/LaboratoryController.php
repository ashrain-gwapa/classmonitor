<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function studentIndex(Request $request)
    {
        $search = $request->input('search');

        $laboratories = Laboratory::when($search, function ($query, $search) {
            return $query->where('lab_name', 'like', "%{$search}%")
                         ->orWhere('section_name', 'like', "%{$search}%");
        })->get();

        return view('dashboard', compact('laboratories'));
    }

    public function facultyIndex(Request $request)
    {
        $search = $request->input('search');

        $laboratories = Laboratory::when($search, function ($query, $search) {
            return $query->where('lab_name', 'like', "%{$search}%")
                         ->orWhere('section_name', 'like', "%{$search}%");
        })->get();

        return view('faculty.dashboard', compact('laboratories'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Available,Occupied',
            'section_name' => 'required_if:status,Occupied|nullable|string|max:50',
        ]);

        $lab = Laboratory::findOrFail($id);
        
        $lab->update([
            'status' => $request->status,
            'section_name' => ($request->status === 'Available') ? null : $request->section_name,
            'updated_by_faculty_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Laboratory status updated!');
    }
}