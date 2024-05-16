<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  new ArticleCollection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article = new Article;

            if (isset($request->file)) {

                $uploadedFiles = $request->file;
                $originalFileName = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = preg_replace('/\s+/', '', $originalFileName) . '-' . uniqid() . '.' . $uploadedFiles->getClientOriginalExtension();
                $uploadedFiles->storeAs('public/uploads/', $fileName);

                $path = $uploadedFiles->store('public/uploads');

                // $uploadedFiles->move(base_path('public_html/storage/uploads'), $fileName);
                $uploadedFiles->move(base_path('public/storage/uploads'), $fileName);


                $filePath = 'uploads/' . $fileName;

                $article->path = $filePath;
            }

            $article->title = $request->title;
            $article->body = $request->body;
            $article->author_id = auth('sanctum')->id();

            $article->save();

            return new ArticleResource($article);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        try {
            if (isset($request->file)) {

                $uploadedFiles = $request->file;
                $originalFileName = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = preg_replace('/\s+/', '', $originalFileName) . '-' . uniqid() . '.' . $uploadedFiles->getClientOriginalExtension();
                $uploadedFiles->storeAs('public/uploads/', $fileName);

                $path = $uploadedFiles->store('public/uploads');

                // $uploadedFiles->move(base_path('public_html/storage/uploads'), $fileName);
                $uploadedFiles->move(base_path('public/storage/uploads'), $fileName);


                $filePath = 'uploads/' . $fileName;

                $article->path = $filePath;
            }

            $article->title = $request->title;
            $article->body = $request->body;
            $article->author_id = auth('sanctum')->id();

            $article->save();

            return new ArticleResource($article);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['data' => 'article deleted successfully']);
    }
}
