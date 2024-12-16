<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'blog_id' => 1,
                'author_user_id' => 2,
                'reply_to_user_id' => 1,
                'content' => 'Great article on AI! Really insightful.',
            ],
            [
                'blog_id' => 1,
                'author_user_id' => 3,
                'reply_to_user_id' => 2,
                'content' => 'I agree, it’s amazing how AI is progressing.',
            ],
            [
                'blog_id' => 2,
                'author_user_id' => 4,
                'reply_to_user_id' => 1,
                'content' => 'The gaming trends this year are exciting!',
            ],
            [
                'blog_id' => 3,
                'author_user_id' => 5,
                'reply_to_user_id' => 1,
                'content' => 'Thanks for sharing these quick workouts. Very helpful!',
            ],
            [
                'blog_id' => 4,
                'author_user_id' => 6,
                'reply_to_user_id' => 1,
                'content' => 'I’ve been to some of these hidden gems, and they’re breathtaking!',
            ],
            [
                'blog_id' => 5,
                'author_user_id' => 7,
                'reply_to_user_id' => 1,
                'content' => 'These recipes look delicious! Can’t wait to try them.',
            ],
            [
                'blog_id' => 6,
                'author_user_id' => 8,
                'reply_to_user_id' => 1,
                'content' => 'Online learning has been a game-changer for me. Great tips!',
            ],
            [
                'blog_id' => 7,
                'author_user_id' => 9,
                'reply_to_user_id' => 1,
                'content' => 'The World Cup highlights were thrilling!',
            ],
            [
                'blog_id' => 8,
                'author_user_id' => 10,
                'reply_to_user_id' => 1,
                'content' => 'Thanks for sharing the latest fashion trends. Very stylish!',
            ],
            [
                'blog_id' => 9,
                'author_user_id' => 1,
                'reply_to_user_id' => 1,
                'content' => 'Space exploration has always fascinated me. Great read!',
            ],
        ]);
    }
}