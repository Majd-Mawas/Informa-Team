<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workshops = Workshop::latest()->paginate(10);
        return view('workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workshops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'Date' => 'required|date',
            'ended_at' => 'required|date|after:Date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        unset($validated['image']);
        if ($request->hasFile('image')) {
            $validated['path'] = $request->file('image')->store('workshops', 'public');
        }

        Workshop::create($validated);

        return redirect()->route('workshops.index')
            ->with('success', 'Workshop created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        return view('workshops.show', compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workshop $workshop)
    {
        return view('workshops.edit', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workshop $workshop)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'Date' => 'required|date',
            'ended_at' => 'required|date|after:Date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        unset($validated['image']);
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($workshop->path) {
                Storage::disk('public')->delete($workshop->path);
            }
            $validated['path'] = $request->file('image')->store('workshops', 'public');
        }

        $workshop->update($validated);

        return redirect()->route('workshops.index')
            ->with('success', 'Workshop updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        // Delete image if exists
        if ($workshop->path) {
            Storage::disk('public')->delete($workshop->path);
        }

        $workshop->delete();

        return redirect()->route('workshops.index')
            ->with('success', 'Workshop deleted successfully.');
    }
}
