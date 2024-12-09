<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_user_id');
            $table->string('title');
            $table->longText('content');
            $table->dateTime('date_created');
            $table->dateTime('date_last_updated');
            $table->boolean('is_public')->default(0);
            $table->boolean('is_available')->default(0);

            $table->foreign('author_user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('blogs');
    }
};
