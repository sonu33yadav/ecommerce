<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('races')->insert([
            ['name' => 'Malay'],
            ['name' => 'Chinese'],
            ['name' => 'Indian']
        ]);
    }
}
