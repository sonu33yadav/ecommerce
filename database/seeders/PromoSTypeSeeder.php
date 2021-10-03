<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoSTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promo_secondary_types')->insert([
            ['type_name' => 'Product'],
            ['type_name' => 'Minimum Spend'],
            ['type_name' => 'Product Category'],
            ['type_name' => 'Customer Birthday'],
            ['type_name' => 'Customer Race'],
            ['type_name' => 'Customer Gender'],
            ['type_name' => 'Customer Registration']
        ]);
    }
}
