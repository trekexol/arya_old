<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rate_types')->insert([
            
            'description' => 'AUTOMATICA',
            'status' => '1',
        ]);
        DB::table('rate_types')->insert([
            
            'description' => 'FIJA',
            'status' => '1',
        ]);
        DB::table('rate_types')->insert([
            
            'description' => 'SIN TASA',
            'status' => '1',
        ]);
    }
}
