<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        product::create([
            'category_id' => '1',
            'name' => 'Hoodie hooligans',
            'price' => '100000',
            'desc' => 'ini adalah hoodie terbaik',
            'image' => 'img/1.png',
            'stok' => '11'
        ]);
        product::create([
            'category_id' => '2',
            'name' => 'Hoodie dobujack',
            'price' => '200000',
            'desc' => 'ini adalah hoodie terbaik',
            'image' => 'img/2.png',
            'stok' => '2'
        ]);
        product::create([
            'category_id' => '3',
            'name' => 'Hoodie roughneck',
            'price' => '250000',
            'desc' => 'ini adalah hoodie terbaik',
            'image' => 'img/3.png',
            'stok' => '11'
        ]);
        product::create([
            'category_id' => '1',
            'name' => 'Hoodie bloods',
            'price' => '300000',
            'desc' => 'ini adalah hoodie terbaik',
            'image' => 'img/4.png',
            'stok' => '11'
        ]);
        product::create([
            'category_id' => '2',
            'name' => 'Hoodie h&m',
            'price' => '350000',
            'desc' => 'ini adalah hoodie terbaik',
            'image' => 'img/5.png',
            'stok' => '11'
        ]);
        product::create([
            'category_id' => '3',
            'name' => 'Hoodie pull & bear',
            'price' => '400000',
            'desc' => 'ini adalah hoodie terbaik',
            'image' => 'img/6.png',
            'stok' => '11'
        ]);
    }
}
