<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserChannelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_channels')->insert([
            ['user_id' => 1, 'channel_id' => 1], // admin subscribed to Tech News
            ['user_id' => 2, 'channel_id' => 2], // john_doe subscribed to Lifestyle
            ['user_id' => 3, 'channel_id' => 3],
            ['user_id' => 4, 'channel_id' => 4],
            ['user_id' => 5, 'channel_id' => 5],
            ['user_id' => 6, 'channel_id' => 6],
            ['user_id' => 7, 'channel_id' => 7],
            ['user_id' => 8, 'channel_id' => 8],
            ['user_id' => 9, 'channel_id' => 9],
            ['user_id' => 10, 'channel_id' => 10],
            ['user_id' => 3, 'channel_id' => 9],
            ['user_id' => 6, 'channel_id' => 9],
            ['user_id' => 8, 'channel_id' => 9],
            ['user_id' => 10, 'channel_id' => 9],
            ['user_id' => 2, 'channel_id' => 8],
            ['user_id' => 3, 'channel_id' => 8],
            ['user_id' => 4, 'channel_id' => 8],
            ['user_id' => 5, 'channel_id' => 8],
            ['user_id' => 6, 'channel_id' => 8],
            ['user_id' => 2, 'channel_id' => 4],
            ['user_id' => 3, 'channel_id' => 4],
            ['user_id' => 4, 'channel_id' => 5],
            ['user_id' => 5, 'channel_id' => 4],
            ['user_id' => 6, 'channel_id' => 4],
            ['user_id' => 1, 'channel_id' => 2],
            ['user_id' => 1, 'channel_id' => 3],
            ['user_id' => 1, 'channel_id' => 4],
            ['user_id' => 1, 'channel_id' => 5],
            ['user_id' => 1, 'channel_id' => 6],
            ['user_id' => 1, 'channel_id' => 7],
            ['user_id' => 1, 'channel_id' => 8],
            ['user_id' => 1, 'channel_id' => 9],
            ['user_id' => 1, 'channel_id' => 10]
        ]);
    }
}