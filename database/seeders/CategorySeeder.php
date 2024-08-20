<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('categories')->insert([
                'name'=>'仏像',
         ]);
         
         DB::table('categories')->insert([
                'name'=>'庭園',
         ]);
         
         DB::table('categories')->insert([
                'name'=>'散策',
         ]);
         
         DB::table('categories')->insert([
                'name'=>'五重塔',
         ]);
         
         DB::table('categories')->insert([
                'name'=>'建物',
         ]);
    }
}
