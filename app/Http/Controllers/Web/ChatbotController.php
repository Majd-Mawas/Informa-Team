<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
class ChatbotController extends Controller
{
    protected $geminiService;
    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }
    /**
     * Process a chatbot message
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'chat_id' => 'nullable|exists:chats,id'
        ]);
        $user = Auth::user();
        $message = $request->input('message');
        // Get or create chat
        if ($request->has('chat_id')) {
            $chat = Chat::findOrFail($request->input('chat_id'));
            // Ensure the chat belongs to the authenticated user
            if ($chat->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access to this chat'
                ], 403);
            }
        } else {
            // Create a new chat
            $chat = Chat::create([
                'user_id' => $user->id,
                'title' => 'Chat ' . now()->format('Y-m-d H:i:s'),
            ]);
        }
        // Save user message
        $userMessage = Message::create([
            'chat_id' => $chat->id,
            'user_id' => $user->id,
            'content' => $message,
            'is_from_user' => true
        ]);
        // Process with Gemini API
        $response = $this->geminiService->sendMessage($message, $chat);
        // Save bot response
        $botMessage = Message::create([
            'chat_id' => $chat->id,
            'user_id' => null,
            'content' => $response['content'],
            'is_from_user' => false,
            'needs_human_support' => $response['needs_human_support']
        ]);
        // Update chat if it needs human support
        if ($response['needs_human_support']) {
            $chat->update(['needs_human_support' => true]);
        }
        return response()->json([
            'success' => true,
            'chat_id' => $chat->id,
            'user_message' => $userMessage,
            'bot_message' => $botMessage,
            'needs_human_support' => $response['needs_human_support']
        ]);
    }
    /**
     * Get all chats that need human support
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChatsNeedingSupport()
    {
        // Only admin users should be able to see this
        if (!Auth::user()->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        $chats = Chat::where('needs_human_support', true)
            ->with(['user', 'messages' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(10);
            }])
            ->get();
        return response()->json([
            'success' => true,
            'chats' => $chats
        ]);
    }
    /**
     * Mark a chat as resolved (no longer needs human support)
     *
     * @param Request $request
     * @param int $chatId
     * @return \Illuminate\Http\JsonResponse
     */
    public function markChatResolved(Request $request, $chatId)
    {
        // Only admin users should be able to do this
        if (!Auth::user()->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $chat = Chat::findOrFail($chatId);
        $chat->update(['needs_human_support' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Chat marked as resolved'
        ]);
    }

    /**
     * Get chat history for a specific user
     *
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChatHistory($userId)
    {
        // Verify the authenticated user has permission to view this history
        $currentUser = Auth::user();

        // Only allow users to view their own chat history or admins to view any history
        if ($currentUser->id != $userId && !$currentUser->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to chat history'
            ], 403);
        }

        // Get all chats for the user with their messages
        $chats = Chat::where('user_id', $userId)
            ->with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'chats' => $chats
        ]);
    }

    public function userChats()
    {
        $chats = Chat::where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'chats' => $chats
        ]);
    }

    /**
     * Get messages for a specific chat
     *
     * @param int $chat_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChatMessages($chat_id)
    {
        // Find the chat
        $chat = Chat::findOrFail($chat_id);
        
        // Verify the authenticated user has permission to view these messages
        $currentUser = Auth::user();
        
        // Only allow users to view their own chat messages or admins to view any messages
        if ($currentUser->id != $chat->user_id && !$currentUser->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to chat messages'
            ], 403);
        }
        
        // Get all messages for the chat ordered by creation time
        $messages = Message::where('chat_id', $chat_id)
            ->orderBy('created_at', 'asc')
            ->get();
        
        return response()->json([
            'success' => true,
            'chat' => $chat,
            'messages' => $messages
        ]);
    }
}
