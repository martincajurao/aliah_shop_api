<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder


{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'SAO',
            'price' => 300,
            'desc' => '1000568795',
            'product_category' => 1,
            'stocks' => 20,
            'img' => '1.jpg',
        ]);
        DB::table('products')->insert([
            'name' => 'OP',
            'price' => 450,
            'desc' => '1000568795',
            'product_category' => 1,
            'stocks' => 8,
            'img' => '2.jpeg',

        ]);
        DB::table('products')->insert([
            'name' => 'AOT',
            'price' => 1550,
            'desc' => '1000568795',
            'product_category' => 1,
            'stocks' => 15,
            'img' => '3.jpg',

        ]);
        DB::table('products')->insert([
            'name' => 'IDM',
            'price' => 750,
            'desc' => '1000568795',
            'product_category' => 1,
            'stocks' => 50,
            'img' => '4.jpg',

        ]);
    }
}
