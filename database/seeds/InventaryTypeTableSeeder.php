<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventaryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventary_types')->insert([
            'description' => 'PRECIO DE ULTIMA COMPRA',
            'status' => '1',
        ]);
        DB::table('inventary_types')->insert([
            'description' => 'PRECIO PROMEDIO',
            'status' => '1',
        ]);
        DB::table('inventary_types')->insert([
            'description' => 'LIFO',
            'status' => '1',
        ]);
    }
}
