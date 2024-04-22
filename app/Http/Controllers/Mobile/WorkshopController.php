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

            $workshop->date = $request->date;
            $workshop->semester = $request->semester;

            $workshop->save();

            return new WorkshopResource($workshop);
        } catch (\Exception $e) {
            abort(500);
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
