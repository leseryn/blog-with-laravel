<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_comment')->insert([
            'post_id' => 1,
            'user_id' => 2,
            'comment' => 'PPPP~~~~A___A~~~~',
            'created_at' => '2023-01-23 20:11:08.000',
        ]);
        DB::table('post_comment')->insert([
            'post_id' => 1,
            'user_id' => 2,
            'comment' => 'QQ!!!',
            'created_at' => '2023-01-23 21:11:08.000',
        ]);
        DB::table('post_comment')->insert([
            'post_id' => 1,
            'user_id' => 1,
            'comment' => 'XDDD',
            'created_at' => '2023-01-23 22:11:08.000',
        ]);
        DB::table('post_comment')->insert([
            'post_id' => 2,
            'user_id' => 2,
            'comment' => 'HAHAHAHA',
            'created_at' => '2023-01-23 19:11:08.000',
        ]);
    }
}
