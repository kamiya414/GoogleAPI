<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class Category_PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category_post')->insert([
                'post_id'=>1,
                'category_id'=>1,
         ]);
         
         DB::table('category_post')->insert([
                'post_id'=>2,
                'category_id'=>1,
         ]);
         
         DB::table('category_post')->insert([
                'post_id'=>3,
                'category_id'=>3,
         ]);
         
         DB::table('category_post')->insert([
                'post_id'=>4,
                'category_id'=>5,
         ]);
         
         DB::table('category_post')->insert([
                'post_id'=>5,
                'category_id'=>4,
         ]);
         
         DB::table('category_post')->insert([
                'post_id'=>5,
                'category_id'=>2,
         ]);
    }
}
