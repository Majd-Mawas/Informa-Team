<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramCollection;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ProgramCollection(Program::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $input = $request->all();

            if (isset($request->file)) {

                $uploadedFiles = $request->file;
                $originalFileName = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = preg_replace('/\s+/', '', $originalFileName) . '-' . uniqid() . '.' . $uploadedFiles->getClientOriginalExtension();
                $uploadedFiles->storeAs('public/uploads/', $fileName);

                $path = $uploadedFiles->store('public/uploads');

                // $uploadedFiles->move(base_path('public_html/storage/uploads'), $fileName);
                $uploadedFiles->move(base_path('public/storage/uploads'), $fileName);


                $filePath = 'uploads/' . $fileName;

                // $program->path = $filePath;
                $input['path'] = $filePath;
            }

            $program =  Program::create($input);

            // $program->Name = $request->name;
            // $program->Released_at = $request->released_at;
            // $program->telegram_link = $request->telegram_link;
            // $program->youtube_link = $request->youtube_link;
            // $program->size = $request->size;
            // $program->description = $request->description;
            // $program->categories_id = $request->categories_id;

            $program->save();

            return new ProgramResource($program);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return new ProgramResource($program);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
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

                $program->path = $filePath;
            }

            $program->Name = $request->name;
            $program->Released_at = $request->released_at;
            $program->telegram_link = $request->telegram_link;
            $program->youtube_link = $request->youtube_link;
            $program->size = $request->size;
            $program->description = $request->description;
            if (isset($request->categories_id)) {
                $program->categories_id = $request->categories_id;
            }

            $program->save();

            return new ProgramResource($program);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return response()->json(['data' => 'program deleted successfully', 'success' => true]);
    }

    public function getProgramsByCategory($category_id)
    {
        $programs = Program::where('categories_id', $category_id)->get();

        return new ProgramCollection($programs);
    }
}
