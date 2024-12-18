<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class blogImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_images')->insert([
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/13.svg',
                'image_id' => '0',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/12.svg',
                'image_id' => '1',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/11.svg',
                'image_id' => '2',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/10.svg',
                'image_id' => '3',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/9.svg',
                'image_id' => '4',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/8.svg',
                'image_id' => '5',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/7.svg',
                'image_id' => '6',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/6.svg',
                'image_id' => '7',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/5.svg',
                'image_id' => '8',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/4.svg',
                'image_id' => '9',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/3.svg',
                'image_id' => '10',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/2.svg',
                'image_id' => '11',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/1.svg',
                'image_id' => '12',
            ],
            [
                'blog_id' => 2,
                'file_path' =>'default_user_icons/0.svg',
                'image_id' => '13',
            ]
        ]);
    }
}