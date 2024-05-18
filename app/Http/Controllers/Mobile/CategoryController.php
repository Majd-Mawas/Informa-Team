<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoriesCollection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CategoriesCollection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;


        if (isset($request->file)) {

            $uploadedFiles = $request->file;
            $originalFileName = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = preg_replace('/\s+/', '', $originalFileName) . '-' . uniqid() . '.' . $uploadedFiles->getClientOriginalExtension();
            $uploadedFiles->storeAs('public/uploads/', $fileName);
            $uploadedFiles->move(base_path('public/storage/uploads'), $fileName);


            $filePath = 'uploads/' . $fileName;

            $category->path = $filePath;
        }

        $category->name = $request->name;

        $category->save();

        return new CategoriesResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoriesResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;

        $category->save();

        return new CategoriesResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['result' => 'category deleted successfully']);
    }
}
