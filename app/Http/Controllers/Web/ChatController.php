<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chat = auth()->user()->chat->first();

        return response()->json(
            [
                'chat' => $chat,
                'success' => true
            ],
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function messages()
    {
        $chat = auth()->user()->chat->first();

        $messages = $chat->messages;

        return response()->json(
            [
                'message' => new MessageCollection($messages),
                'success' => true
            ],
            200
        );
    }

    public function all_chats()
    {
        $chats = Chat::with('user')->orderByDesc('created_at')->get();

        return response()->json(
            [
                'chats' => $chats,
                'success' => true
            ],
            200
        );
    }

    public function chat_messages(Request $request)
    {
        $messages = Message::where('chat_id', $request->chat_id)->get();

        return response()->json(
            [
                'message' => new MessageCollection($messages),
                'success' => true
            ],
            200
        );
    }
}
