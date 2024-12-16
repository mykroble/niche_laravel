<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channel')->insert([
            [
                'title' => 'Tech News',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Gaming',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => false,
            ],
            [
                'title' => 'Health & Fitness',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Travel Diaries',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Food & Recipes',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Education & Learning',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => false,
            ],
            [
                'title' => 'Sports Highlights',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Fashion & Style',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Science & Technology',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
            [
                'title' => 'Entertainment News',
                'date_created' => now(),
                'date_last_updated' => now(),
                'is_public' => true,
            ],
        ]);
    }
}