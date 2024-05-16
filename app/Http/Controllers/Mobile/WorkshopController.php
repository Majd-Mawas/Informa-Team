<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Http\Resources\WorkshopResource;
use App\Http\Resources\WorkshopCollection;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new WorkshopCollection(Workshop::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $workshop = new Workshop;


            if (isset($request->file)) {

                $uploadedFiles = $request->file;
                $originalFileName = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = preg_replace('/\s+/', '', $originalFileName) . '-' . uniqid() . '.' . $uploadedFiles->getClientOriginalExtension();
                $uploadedFiles->storeAs('public/uploads/', $fileName);

                $path = $uploadedFiles->store('public/uploads');

                // $uploadedFiles->move(base_path('public_html/storage/uploads'), $fileName);
                $uploadedFiles->move(base_path('public/storage/uploads'), $fileName);

                $filePath = 'uploads/' . $fileName;

                $workshop->path = $filePath;
            }

            $workshop->Date = $request->Date;
            $workshop->title = $request->title;
            $workshop->description = $request->description;


            $workshop->ended_at = $request->ended_at;

            $workshop->save();
            // return "sad";

            return new WorkshopResource($workshop);
        } catch (\Exception $e) {
            // abort(500);
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Workshop $workshop)
    {
        return new WorkshopResource($workshop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workshop $workshop)
    {
        try {

            $workshop->update($request->all());

            return new WorkshopResource($workshop);
        } catch (\Exception $e) {
            abort(500);
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop)
    {
        try {

            $workshop->delete();

            return response()->json(["data" => "Workshop Deleted Successfully"]);
        } catch (\Exception $e) {
            abort(500);
            return $e;
        }
    }
}
