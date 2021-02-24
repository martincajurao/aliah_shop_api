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
            'name' => 'Tshirt',
            'price' => 320,
            'desc' => 'this is Tshirt',
            'product_category' => 1,
            'stocks' => 200,
            'img' => '',
        ]);
        DB::table('products')->insert([
            'name' => 'Shorts',
            'price' => 150,
            'desc' => 'this is Shorts',
            'product_category' => 1,
            'stocks' => 150,
            'img' => '',

        ]);
    }
}
