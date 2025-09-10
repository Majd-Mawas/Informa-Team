<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with('category')->latest()->paginate(10);
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('programs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Released_at' => 'required|date',
            'categories_id' => 'required|exists:categories,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'telegram_link' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('path')) {
            $validated['path'] = $request->file('path')->store('programs', 'public');
        }

        Program::create($validated);

        return redirect()->route('programs.index')
            ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $categories = Category::all();
        return view('programs.edit', compact('program', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Released_at' => 'required|date',
            'categories_id' => 'required|exists:categories,id',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'telegram_link' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('path')) {
            // Delete old file if exists
            if ($program->path) {
                Storage::disk('public')->delete($program->path);
            }
            $validated['path'] = $request->file('path')->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('programs.index')
            ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // Delete file if exists
        if ($program->path) {
            Storage::disk('public')->delete($program->path);
        }

        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}
