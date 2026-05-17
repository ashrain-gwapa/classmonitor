<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    /**
     * FIX: Added studentIndex method to match your routes/web.php configuration!
     * Handles search filters for the main workspace administration dashboard.
     */
    public function studentIndex(Request $request)
    {
        // 1. Capture the text string from the URL query parameter (?search=...)
        $search = $request->input('search');

        // 2. Fetch data dynamically and apply conditional search filtering
        $laboratories = Laboratory::with('faculty') // Pull the relationship data cleanly
            ->when($search, function ($query, $search) {
                return $query->where('lab_name', 'like', "%{$search}%")
                             ->orWhere('section_name', 'like', "%{$search}%")
                             ->orWhereHas('faculty', function ($q) use ($search) {
                                 $q->where('name', 'like', "%{$search}%");
                             });
            })
            ->get();

        // 3. Return the workspace dashboard view with the filtered collection
        return view('dashboard', compact('laboratories'));
    }

    /**
     * Fallback index method pointing to the main dashboard
     */
    public function index(Request $request)
    {
        return $this->studentIndex($request);
    }

    public function facultyIndex(Request $request)
    {
        $search = $request->input('search');

        $laboratories = Laboratory::with('faculty')->when($search, function ($query, $search) {
            return $query->where('lab_name', 'like', "%{$search}%")
                         ->orWhere('section_name', 'like', "%{$search}%")
                         ->orWhereHas('faculty', function ($q) use ($search) {
                             $q->where('name', 'like', "%{$search}%");
                         });
        })->get();

        return view('faculty.dashboard', compact('laboratories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_name' => 'required|string|max:100',
            'section_name' => 'nullable|string|max:50',
            'status' => 'required|in:Available,Occupied',
        ]);

        Laboratory::create([
            'lab_name' => $request->lab_name,
            'status' => $request->status,
            'section_name' => $request->section_name, 
            'updated_by_faculty_id' => auth()->id(), 
        ]);

        return redirect()->back()->with('success', 'New laboratory created successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'lab_name' => 'required|string|max:100', 
            'status' => 'required|in:Available,Occupied',
            'section_name' => 'nullable|string|max:50',
        ]);

        $lab = Laboratory::findOrFail($id);
        
        $lab->update([
            'lab_name' => $request->lab_name, 
            'status' => $request->status,
            'section_name' => $request->section_name, 
            'updated_by_faculty_id' => auth()->id(), 
        ]);

        return redirect()->back()->with('success', 'Laboratory data updated successfully!');
    }

    public function destroy($id)
    {
        $lab = Laboratory::findOrFail($id);
        $lab->delete();

        return redirect()->back()->with('success', 'Laboratory successfully deleted!');
    }

    /**
     * SHOWS ONLY THE LOGGED-IN FACULTY'S FORMS IN THE MANAGEMENT PANEL
     */
    public function managementPanel(Request $request)
    {
        $search = $request->input('search');

        $laboratories = Laboratory::with('faculty')
            ->where('updated_by_faculty_id', auth()->id())
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('lab_name', 'like', "%{$search}%")
                      ->orWhere('section_name', 'like', "%{$search}%");
                });
            })->get();

        return view('faculty.panel', compact('laboratories')); 
    }
}