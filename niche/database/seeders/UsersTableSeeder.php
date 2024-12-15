<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'john_doe',
                'email' => 'john.doe@example.com',
                'display_name' => 'John Doe',
                'birthday' => '1990-05-15',
                'age' => 34,
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'jane_smith',
                'email' => 'jane.smith@example.com',
                'display_name' => 'Jane Smith',
                'birthday' => '1985-10-22',
                'age' => 39,
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mark_twain',
                'email' => 'mark.twain@example.com',
                'display_name' => 'Mark Twain',
                'birthday' => '1995-04-10',
                'age' => 29,
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'lucy_heartfilia',
                'email' => 'lucy.heartfilia@example.com',
                'display_name' => 'Lucy Heartfilia',
                'birthday' => '1998-07-20',
                'age' => 26,
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'edward_elric',
                'email' => 'edward.elric@example.com',
                'display_name' => 'Edward Elric',
                'birthday' => '2000-12-03',
                'age' => 24,
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'emma_watson',
                'email' => 'emma.watson@example.com',
                'display_name' => 'Emma Watson',
                'birthday' => '1994-02-15',
                'age' => 30,
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'leo_messi',
                'email' => 'leo.messi@example.com',
                'display_name' => 'Leo Messi',
                'birthday' => '1987-06-24',
                'age' => 37,
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sakura_haruno',
                'email' => 'sakura.haruno@example.com',
                'display_name' => 'Sakura Haruno',
                'birthday' => '2001-03-28',
                'age' => 23,
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'bruce_wayne',
                'email' => 'bruce.wayne@example.com',
                'display_name' => 'Bruce Wayne',
                'birthday' => '1981-09-17',
                'age' => 43,
                'gender' => 'male',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'natasha_romanoff',
                'email' => 'natasha.romanoff@example.com',
                'display_name' => 'Natasha Romanoff',
                'birthday' => '1984-11-22',
                'age' => 40,
                'gender' => 'female',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}