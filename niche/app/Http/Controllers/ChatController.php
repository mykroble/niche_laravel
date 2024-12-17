<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        // Get the ID of the authenticated user
        $authUserId = Auth::id();
    
        // Get all users except the authenticated user
        $users = User::where('id', '!=', $authUserId)->get();
    
        // Get the current user for the chat, fall back to the first user if not provided
        $currentUserId = $request->user_id ?? $users->first()?->id;
    
        // Fetch the user object for the selected current user
        $currentUser = $currentUserId ? User::find($currentUserId) : null;
    
        // Retrieve messages between the authenticated user and the selected user, ordered by created_at in ascending order
        $messages = $currentUser ? Message::where(function ($query) use ($authUserId, $currentUserId) {
            $query->where('sender_id', $authUserId)
                  ->where('receiver_id', $currentUserId);
        })->orWhere(function ($query) use ($authUserId, $currentUserId) {
            $query->where('sender_id', $currentUserId)
                  ->where('receiver_id', $authUserId);
        })->orderBy('created_at', 'asc')->get() : collect();
    
        // Return the view with the required data
        return view('message', [
            'users' => $users,
            'messages' => $messages, // No grouping by sender_id, just all messages sorted by created_at
            'currentUser' => $currentUser,
        ]);
    }
    
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);
    
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message'],
        ]);
    
        return response()->json(['message' => $message]);
    }
    // Add this method to the ChatController
    public function getNewMessages(Request $request)
    {
        $authUserId = Auth::id();
        $lastMessageId = $request->last_message_id;
    
        // Fetch new messages created after the last seen message ID
        $messages = Message::where('id', '>', $lastMessageId)
                            ->where(function ($query) use ($authUserId) {
                                $query->where('receiver_id', $authUserId)
                                      ->orWhere('sender_id', $authUserId);
                            })
                            ->orderBy('created_at', 'asc')
                            ->get();
    
        return response()->json($messages);
    }
    

    
}
