<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'login' => 'trekexol',
            'email' => 'CEFREITAS.16@GMAIL.COM',
            'code_rif' => '00354138-9',
            'razon_social' => 'Empresa DEMO ARYA',
            'period' => 2021,
            'phone' => '04242041615',
            'address' => 'PLAZA VENEZUELA',
            'franqueo_postal' => '1010',
            'tax_1' => 16,
            'tax_2' => 0,
            'tax_3' => 0,
            'retention_islr' => 0,
            'tipoinv_id' => 1,
            'tiporate_id' => 1,
            'rate' => 3115193.41,
            'rate_petro' => 9000000.00,
            'foto_company' => 'default',
            'status' => '1',
        ]);
        
    }
}
