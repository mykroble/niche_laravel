<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'author_user_id' => 1,
                'title' => 'The Future of AI in 2024',
                'content' => 'Artificial intelligence is shaping the world with groundbreaking innovations.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 1, // Tech News
            ],
            [
                'author_user_id' => 2,
                'title' => 'Top 10 Gaming Trends of the Year',
                'content' => 'The gaming world is evolving rapidly with new technologies.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 2, // Gaming
            ],
            [
                'author_user_id' => 3,
                'title' => '5 Quick Workouts for Busy People',
                'content' => 'Staying fit doesn’t have to be time-consuming. Here are 5 quick workouts.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 3, // Health & Fitness
            ],
            [
                'author_user_id' => 4,
                'title' => 'Exploring Hidden Gems in Europe',
                'content' => 'Discover beautiful and less-traveled destinations in Europe.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 4, // Travel Diaries
            ],
            [
                'author_user_id' => 5,
                'title' => '10 Delicious Recipes for Beginners',
                'content' => 'Start cooking with these easy-to-follow recipes.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 5, // Food & Recipes
            ],
            [
                'author_user_id' => 1,
                'title' => 'Mastering Online Learning',
                'content' => 'Tips and tools to make your online learning experience effective.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => false,
                'is_available' => true,
                'channel_id' => 6, // Education & Learning
            ],
            [
                'author_user_id' => 6,
                'title' => 'Highlights from the Latest World Cup',
                'content' => 'The biggest moments from this year’s World Cup.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 7, // Sports Highlights
            ],
            [
                'author_user_id' => 7,
                'title' => 'Latest Trends in Fashion for 2024',
                'content' => 'Fashion evolves every year, and 2024 is no exception.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 8, // Fashion & Style
            ],
            [
                'author_user_id' => 8,
                'title' => 'Space Exploration: What’s Next?',
                'content' => 'Humanity is reaching new heights in space exploration.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 9, // Science & Technology
            ],
            [
                'author_user_id' => 9,
                'title' => 'Breaking News in Entertainment',
                'content' => 'The entertainment industry is buzzing with exciting news.',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
                'is_available' => true,
                'channel_id' => 10, // Entertainment News
            ],
        ]);
    }
}