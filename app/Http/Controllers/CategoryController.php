<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = [
            'name' => $validated['name'],
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['path'] = $imagePath;
        }

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = [
            'name' => $validated['name'],
        ];

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('image')->store('categories', 'public');
            $data['path'] = $imagePath;
        }

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Delete or handle related courses
            if ($category->courses()->count() > 0) {
                // Option 1: Delete related courses
                $category->courses()->delete();
                // Option 2: Set courses category to null (if your database allows)
                // $category->courses()->update(['categories_id' => null]);
            }

            // Delete or handle related programs
            if ($category->programs()->count() > 0) {
                // Option 1: Delete related programs
                $category->programs()->delete();
                // Option 2: Set programs category to null (if your database allows)
                // $category->programs()->update(['categories_id' => null]);
            }

            // Delete or handle related programs
            if ($category->products()->count() > 0) {
                // Option 1: Delete related products
                $category->products()->delete();
                // Option 2: Set products category to null (if your database allows)
                // $category->products()->update(['categories_id' => null]);
            }

            // Delete the category itself
            $category->delete();

            // Commit the transaction
            DB::commit();

            return redirect()->route('categories.index')
                ->with('success', 'Category and its related items deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            logger()->info($e->getMessage());
            return redirect()->route('categories.index')
                ->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }
}
