<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //added
        // Schema::create('channel', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->dateTime('date_created');
        //     $table->dateTime('date_last_updated');
        //     $table->boolean('is_public')->default(0);
        // });
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_user_id');
            $table->string('title');
            $table->longText('content');
            $table->dateTime('date_created');
            $table->dateTime('date_last_updated');
            $table->boolean('is_public')->default(0);
            $table->boolean('is_banned')->default(0);
            $table->unsignedBigInteger('channel_id');
            $table->foreign('channel_id')->references('id')->on('channel')->onDelete('cascade');//added
            $table->foreign('author_user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('user_conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('other_user_id');
            $table->boolean('havetalked')->default(0);  
            $table->timestamps();
            $table->unique(['user_id', 'other_user_id']);
        });
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('blog_id');
            $table->timestamp('date_added')->useCurrent();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->unique(['user_id', 'blog_id']);
        });

        Schema::create('user_channels', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('channel_id');
            $table->dateTime('date_added');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('channel_id')->references('id')->on('channel')->onDelete('cascade');
        });
        Schema::create('blog_images', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->string('file_path');
            $table->integer('image_id');
            $table->string('alt')->default('uploaded image');
            
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        Schema::create('comments', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('author_user_id');
            $table->unsignedBigInteger('reply_to_user_id');
            $table->longText('content');

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('author_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reply_to_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('blog_images');
        Schema::dropIfExists('bookmarks');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('user_channels');
        Schema::dropIfExists('channel');
    }
};
