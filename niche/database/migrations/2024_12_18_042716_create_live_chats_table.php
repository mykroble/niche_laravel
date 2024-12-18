<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_chats', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key for live_chats
            $table->unsignedBigInteger('channel_id');  // Use unsignedBigInteger for the foreign key to channels table
            $table->foreign('channel_id')->references('id')->on('channel')->onDelete('cascade');  // Foreign key constraint for channels
            
            $table->unsignedBigInteger('user_id');  // Add user_id for the user sending the message
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Foreign key constraint for users
            
            $table->text('comment_content');  // Column to store messages (renamed to match your code)
            $table->timestamps();  // Timestamps for created_at and updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('live_chats');
    }
}
