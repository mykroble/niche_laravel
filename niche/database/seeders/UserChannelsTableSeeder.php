<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserChannelsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_channels')->insert([
            ['user_id' => 1, 'channel_id' => 1,'date_added' => now()], // admin subscribed to Tech News
            ['user_id' => 2, 'channel_id' => 2,'date_added' => now()],
            ['user_id' => 3, 'channel_id' => 3,'date_added' => now()],
            ['user_id' => 4, 'channel_id' => 4,'date_added' => now()],
            ['user_id' => 5, 'channel_id' => 5,'date_added' => now()],
            ['user_id' => 6, 'channel_id' => 6,'date_added' => now()],
            ['user_id' => 7, 'channel_id' => 7,'date_added' => now()],
            ['user_id' => 8, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 9, 'channel_id' => 9,'date_added' => now()],
            ['user_id' => 10, 'channel_id' => 10,'date_added' => now()],
            ['user_id' => 3, 'channel_id' => 9,'date_added' => now()],
            ['user_id' => 6, 'channel_id' => 9,'date_added' => now()],
            ['user_id' => 8, 'channel_id' => 9,'date_added' => now()],
            ['user_id' => 10, 'channel_id' => 9,'date_added' => now()],
            ['user_id' => 2, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 3, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 4, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 5, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 6, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 2, 'channel_id' => 4,'date_added' => now()],
            ['user_id' => 3, 'channel_id' => 4,'date_added' => now()],
            ['user_id' => 4, 'channel_id' => 5,'date_added' => now()],
            ['user_id' => 5, 'channel_id' => 4,'date_added' => now()],
            ['user_id' => 6, 'channel_id' => 4,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 2,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 3,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 4,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 5,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 6,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 7,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 8,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 9,'date_added' => now()],
            ['user_id' => 1, 'channel_id' => 10,'date_added' => now()]
        ]);
    }
}