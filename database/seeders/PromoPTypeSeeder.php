<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoPTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promo_primary_types')->insert([
            ['type_name' => 'Percentage'],
            ['type_name' => 'Value'],
            ['type_name' => 'Free Shipping']
        ]);
    }
}
