<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if (isset($request->file)) {

            $uploadedFiles = $request->file;
            $originalFileName = pathinfo($uploadedFiles->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = preg_replace('/\s+/', '', $originalFileName) . '-' . uniqid() . '.' . $uploadedFiles->getClientOriginalExtension();
            $uploadedFiles->storeAs('public/uploads/', $fileName);
            $uploadedFiles->move(base_path('public/storage/uploads'), $fileName);

            $input['path'] = 'uploads/' . $fileName;
            unset($input['file']);
        }

        if (isset($request->type) && $request->type == 'out') {

            $user = Auth::user();
            $input['user_id'] = $user->id;
            $chat = $user->chat->first();
            Log::alert($chat);
            $input['chat_id'] = $chat->id;
        }

        Message::create($input);

        return response()->json(['success' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
