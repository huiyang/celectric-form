<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Currency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('currencies')->insert([
            'name' => 'Malaysia',
            'code' => 'MYR',
            'symbol' => 'RM',
            'format' => 'RM1,000',
            'exchange_rate' => 4,
            'active' => 1,
        ]);

        DB::table('currencies')->insert([
            'name' => 'US Dollar',
            'code' => 'USD',
            'symbol' => '$',
            'format' => '$1,000',
            'exchange_rate' => 1,
            'active' => 1,
        ]);
    }
}
