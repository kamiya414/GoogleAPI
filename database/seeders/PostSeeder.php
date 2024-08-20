<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('posts')->insert([
                'user_id'=>1,
                'place_id'=>1,
                'title' => 'テスト',
                'temple' => '東寺',
                'image'=>'写真',
                'comment'=>'五重塔',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        
        DB::table('posts')->insert([
                'user_id'=>2,
                'place_id'=>2,
                'title' => 'テスト2',
                'temple' => '建長寺',
                'image'=>'写真',
                'comment'=>'鎌倉五山',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         
         DB::table('posts')->insert([
                'user_id'=>3,
                'place_id'=>3,
                'title' => 'テスト3',
                'temple' => '醍醐寺',
                'image'=>'写真',
                'comment'=>'薬師如来像',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         
         DB::table('posts')->insert([
                'user_id'=>4,
                'place_id'=>4,
                'title' => 'テスト4',
                'temple' => '東大寺',
                'image'=>'写真',
                'comment'=>'盧遮那仏',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         
         DB::table('posts')->insert([
                'user_id'=>5,
                'place_id'=>5,
                'title' => 'テスト5',
                'temple' => '厳島神社',
                'image'=>'写真',
                'comment'=>'鳥居',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         
    }
}
