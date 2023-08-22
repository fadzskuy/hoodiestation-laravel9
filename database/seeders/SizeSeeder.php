<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            'name' => 'S',
        ]);
        DB::table('sizes')->insert([
            'name' => 'M',
        ]);
        DB::table('sizes')->insert([
            'name' => 'L',
        ]);
        DB::table('sizes')->insert([
            'name' => 'XL',
        ]);
        DB::table('sizes')->insert([
            'name' => 'XXL',
        ]);
    }
}
