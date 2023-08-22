<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Man',
        ]);
        DB::table('categories')->insert([
            'name' => 'Woman',
        ]);
        DB::table('categories')->insert([
            'name' => 'Unisex',
        ]);
    }
}
