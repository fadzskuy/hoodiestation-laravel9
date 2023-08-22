<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            user::create([
                'name' => 'fadli gz',
                'email' => 'falih.fadli96@gmail.com',
                'username' => 'fadliii',
                'password' => bcrypt('falih'),
                'phone' => '085882329865',
                'address' => 'bogor'
            ]);
        }
    }
}
