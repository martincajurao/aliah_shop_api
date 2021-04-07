<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Shirt',
            'status' => 'Active',
        ]);
        DB::table('categories')->insert([
            'name' => 'Jeans',
            'status' => 'Active',
        ]);
        DB::table('categories')->insert([
            'name' => 'Babies',
            'status' => 'Active',
        ]);
        DB::table('categories')->insert([
            'name' => 'Hoodies',
            'status' => 'Active',
        ]);
    }
}
