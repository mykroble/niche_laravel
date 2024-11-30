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
        // convert to non static. i feel like i was very close but AHHH
        $authUserId = 2;

        
        $users = User::where('id', '!=', $authUserId)->get();

        
        $currentUserId = $request->user_id ?? $users->first()?->id;

        
        $currentUser = $currentUserId ? User::find($currentUserId) : null;

        
        $messages = $currentUser ? Message::where(function ($query) use ($authUserId, $currentUserId) {
            $query->where('sender_id', $authUserId)
                  ->where('receiver_id', $currentUserId);
        })->orWhere(function ($query) use ($authUserId, $currentUserId) {
            $query->where('sender_id', $currentUserId)
                  ->where('receiver_id', $authUserId);
        })->orderBy('created_at', 'asc')->get() : collect();

        return view('message', [
            'users' => $users,
            'groupedMessages' => $messages->groupBy('sender_id'),
            'currentUser' => $currentUser,
        ]);
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message'],
        ]);


        return redirect()->route('message', ['user_id' => $validated['receiver_id']]);
    }
}