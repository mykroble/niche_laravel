<?php

namespace App\Http\Controllers;
use App\Models\LiveChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    // Load Homepage with channels, blogs, and bookmarked blogs
    public function loadHomepage(Request $request)
    {
        $selectedChannelId = $request->input('channel_id'); // Capture selected channel
    
        // Retrieve channels the user has joined
        $channels = DB::table('user_channels')
            ->join('channel', 'user_channels.channel_id', '=', 'channel.id')
            ->where('user_channels.user_id', Auth::id())
            ->orderBy('user_channels.id', 'asc')
            ->select('channel.*', 'user_channels.date_added')
            ->get();
    
        // Retrieve blogs associated with user's channels
        $blogsQuery = DB::table('blogs')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->join('channel', 'blogs.channel_id', '=', 'channel.id')
            ->join('user_channels', 'blogs.channel_id', '=', 'user_channels.channel_id')
            ->where('user_channels.user_id', Auth::id())
            ->where('blogs.is_banned', '!=', 1)
            ->where('users.is_banned', '!=', 1)
            ->select(
                'blogs.*',
                'users.display_name',
                'users.username',
                'users.icon_file_path',
                'channel.title AS channelTitle'
            )
            ->orderBy('blogs.date_created', 'desc');
    
        if ($selectedChannelId) {
            $blogsQuery->where('blogs.channel_id', $selectedChannelId);
        }
    
        $blogs = $blogsQuery->limit(100)->get();
    
        // Retrieve bookmarked blog IDs
        $bookmarkedBlogIds = DB::table('bookmarks')
            ->where('user_id', Auth::id())
            ->pluck('blog_id')
            ->toArray();
    
        // Fetch messages for the selected channel (if available)
        $messages = [];
        if ($selectedChannelId) {
            $messages = DB::table('live_chats')
                ->join('users', 'live_chats.user_id', '=', 'users.id')
                ->where('live_chats.channel_id', $selectedChannelId)
                ->select('live_chats.*', 'users.display_name as username')
                ->orderBy('live_chats.created_at', 'asc')
                ->get();
        }
    
        return view('homepage', compact('blogs', 'channels', 'selectedChannelId', 'bookmarkedBlogIds', 'messages'));
    }
    

    // Bookmark a blog
    public function bookmarkBlog(Request $request)
    {
        $blogId = $request->input('blog_id');
        $userId = Auth::id();

        $alreadyBookmarked = DB::table('bookmarks')
            ->where('user_id', $userId)
            ->where('blog_id', $blogId)
            ->exists();

        if (!$alreadyBookmarked) {
            DB::table('bookmarks')->insert([
                'user_id' => $userId,
                'blog_id' => $blogId,
                'date_added' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    // Show bookmarked blogs
    public function showBookmarks()
    {
        $bookmarks = DB::table('bookmarks')
            ->join('blogs', 'bookmarks.blog_id', '=', 'blogs.id')
            ->join('users', 'blogs.author_user_id', '=', 'users.id')
            ->select(
                'blogs.id',
                'blogs.title',
                'blogs.content',
                'blogs.date_created',
                'users.username',
                'users.display_name'
            )
            ->where('bookmarks.user_id', Auth::id())
            ->where('blogs.is_banned', 0)
            ->where('users.is_banned', 0)
            ->orderBy('bookmarks.date_added', 'desc')
            ->get();

        return view('bookmarks', ['blogs' => $bookmarks]);
    }
    public function sendMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'channel_id' => 'required|integer|exists:channel,id',
                'comment_content' => 'required|string|max:1000',
            ]);
    
            $userId = auth()->check() ? auth()->id() : 0;
    
            // Store the message
            $message = $this->storeMessage($validated['channel_id'], $validated['comment_content'], $userId);
    
            if ($message) {
                return response()->json([
                    'success' => true,
                    'message' => $message, // Send the full message details
                ]);
            }
    
            return response()->json(['error' => 'Failed to send message'], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation error', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Unexpected error while sending message: ' . $e->getMessage());
            return response()->json(['error' => 'Unexpected error occurred'], 500);
        }
    }
    
        public function storeMessage($channelId, $commentContent, $userId)
        {
            try {
                // Insert the message
                $messageId = DB::table('live_chats')->insertGetId([
                    'channel_id' => $channelId,
                    'user_id' => $userId,
                    'message' => $commentContent,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        
                // Retrieve the inserted message with user details
                $message = DB::table('live_chats')
                    ->join('users', 'live_chats.user_id', '=', 'users.id')
                    ->where('live_chats.id', $messageId)
                    ->select('live_chats.id', 'live_chats.message', 'live_chats.created_at', 'users.display_name as username')
                    ->first();
        
                return $message; // Return the full message data
            } catch (\Exception $e) {
                \Log::error('Error storing live chat message', [
                    'exception' => $e->getMessage(),
                    'channel_id' => $channelId,
                    'user_id' => $userId,
                    'comment_content' => $commentContent,
                ]);
        
                return null;
            }
        }
        
        
        
        
        
    
    
    
    

        public function getMessages(Request $request)
{
    try {
        // Log incoming request data
        \Log::info('Fetching messages for channel:', $request->all());

        $channelId = $request->input('channel_id');

        // Ensure channel_id is provided
        if (!$channelId) {
            \Log::error('No channel_id provided.');
            return response()->json(['error' => 'Channel ID is required'], 400);
        }

        // Retrieve messages for the given channel
        $messages = DB::table('live_chats')
            ->join('users', 'live_chats.user_id', '=', 'users.id')
            ->where('live_chats.channel_id', $channelId)
            ->select('live_chats.id', 'live_chats.message', 'live_chats.created_at', 'users.display_name as username')
            ->orderBy('live_chats.created_at', 'asc')
            ->get();

        // Log the fetched messages
        \Log::info('Fetched messages:', ['messages' => $messages]);

        // Return the messages as JSON
        return response()->json($messages);
    } catch (\Exception $e) {
        \Log::error('Error fetching messages: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to fetch messages'], 500);
    }
}


public function fetchNewMessages(Request $request)
{
    try {
        // Log incoming request data
        \Log::info('Fetching new messages for channel:', $request->all());
        
        $channelId = $request->input('channel_id');
        $lastFetchedAt = $request->input('last_fetched_at');
        
        // Ensure channel_id and last_fetched_at are provided
        if (!$channelId || !$lastFetchedAt) {
            \Log::error('Missing required parameters: channel_id or last_fetched_at');
            return response()->json(['error' => 'Both channel_id and last_fetched_at are required'], 400);
        }
        
        // Retrieve new messages that are newer than the last fetched timestamp
        $newMessages = DB::table('live_chats')
            ->join('users', 'live_chats.user_id', '=', 'users.id')
            ->where('live_chats.channel_id', $channelId)
            ->where('live_chats.created_at', '>', $lastFetchedAt)
            ->select('live_chats.id', 'live_chats.message', 'live_chats.created_at', 'users.display_name as username')
            ->orderBy('live_chats.created_at', 'asc')
            ->get();
        
        // Log the new messages for debugging purposes
        \Log::info('Fetched new messages:', ['newMessages' => $newMessages]);
        
        // Return the new messages as JSON
        return response()->json($newMessages);
    } catch (\Exception $e) {
        \Log::error('Error fetching new messages: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to fetch new messages'], 500);
    }
}


    // Fetch channels that the user is registered to
    public function getUserChannels()
    {
        // Retrieve the channels the user is registered to
        $channels = DB::table('user_channels')
            ->join('channel', 'user_channels.channel_id', '=', 'channel.id')
            ->where('user_channels.user_id', Auth::id())
            ->orderBy('user_channels.id', 'asc')
            ->select('channel.*')
            ->get();

        return response()->json($channels);
    }
}
