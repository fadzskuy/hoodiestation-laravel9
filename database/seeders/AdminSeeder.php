<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            Admin::create([
                'name' => 'fadli ganz',
                'email' => 'admin@gmail.com',
                'username' => 'fadlii',
                'password' => bcrypt('12345'),
                'phone' => '08872472887',
                'address' => 'bogor men'
            ]);
        }
    }
}
