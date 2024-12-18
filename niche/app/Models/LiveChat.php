<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveChat extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'live_chats';

    // Define which attributes can be mass-assigned
    protected $fillable = ['channel_id', 'user_id', 'comment_content'];

    // Define the relationship with the User model (sender)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // You can define a custom method to get static channel details if needed.
    public function getChannel()
    {
        // Assuming you have a static table for channels (e.g., 'channel')
        return \DB::table('channel')->where('id', $this->channel_id)->first();
    }
}
