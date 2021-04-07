<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'name' => 'RED',
            'code' => '#eee',
        ]);
        DB::table('colors')->insert([
            'name' => 'BLUE',
            'code' => '#eee',
        ]);
        DB::table('colors')->insert([
            'name' => 'YELLOW',
            'code' => '#eee',
        ]);
        DB::table('colors')->insert([
            'name' => 'BLACK',
            'code' => '#eee',
        ]);
        DB::table('colors')->insert([
            'name' => 'WHITE',
            'code' => '#eee',
        ]);
    }
}
