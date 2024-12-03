<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('blog_id');
            $table->unsignedBigInteger('author_user_id');
            $table->string('title');
            $table->longText('content');
            $table->dateTime('date_created');
            $table->dateTime('date_last_updated');
            $table->boolean('is_public')->default(0);

            $table->foreign('author_user_id')->reference('user_id')->on('user')->onDelete('cascade');
        });
        
        Schema::create('blog_images', function(Blueprint $table){
            $table->id('blog_image_id');
            $table->unsignedBigInteger('blog_id');
            $table->string('file_path');
            $table->string('alt');
            
            $table->foreign('blog_id')->reference('blog_id')->on('blog')->onDelete('cascade');
        });

        Schema::create('comments', function(Blueprint $table){
            $table->id('comment_id');
            $table->unsingedBigInteger('blog_id');
            $table->unsingedBigInteger('author_user_id');
            $table->unsingedBigInteger('reply_to_user_id');
            $table->longText('content');

            $table->foreign('blog_id')->reference('blog_id')->on('blog')->onDelete('cascade');
            $table->foreign('author_user_id')->reference('user_id')->on('user')->onDelete('cascade');
            $table->foreign('reply_to_user_id')->reference('user_id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
