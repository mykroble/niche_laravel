<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    
    public function fetchUserMessages(Request $request)
{
    $currentUserId = Auth::id();
    $selectedUserId = $request->input('user_id');

    // Fetch the selected user's information
    $selectedUser = DB::table('users')->where('id', $selectedUserId)->first();

    // Fetch messages between the logged-in user and the selected user
    $messages = DB::table('messages')
        ->where(function ($query) use ($currentUserId, $selectedUserId) {
            $query->where('sender_id', $currentUserId)
                  ->where('receiver_id', $selectedUserId);
        })
        ->orWhere(function ($query) use ($currentUserId, $selectedUserId) {
            $query->where('sender_id', $selectedUserId)
                  ->where('receiver_id', $currentUserId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    // Return response as JSON
    return response()->json([
        'user_name' => $selectedUser->display_name,
        'user_image' => asset('images/user1.jpg'), // Replace with dynamic image if available
        'messages' => $messages,
    ]);
}

    public function store(Request $request)
    {
        DB::table('messages')->insert([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->input('receiver_id'),
            'message' => $request->input('message'),
            'created_at' => now(),
        ]);
    
        return redirect()->back();
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
    

    public function showMessages(Request $request, $user_id)
{
    $currentUserId = Auth::id();

    // Fetch all users for the sidebar
    $users = DB::table('users')->where('id', '!=', $currentUserId)->get();

    // Fetch messages between the logged-in user and the selected user
    $messages = DB::table('messages')
        ->where(function ($query) use ($currentUserId, $user_id) {
            $query->where('sender_id', $currentUserId)
                  ->where('receiver_id', $user_id);
        })
        ->orWhere(function ($query) use ($currentUserId, $user_id) {
            $query->where('sender_id', $user_id)
                  ->where('receiver_id', $currentUserId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

    // Fetch selected user's info for the chat header
    $currentUser = DB::table('users')->where('id', $user_id)->first();

    return view('messages', compact('users', 'messages', 'currentUser'));
}
}
