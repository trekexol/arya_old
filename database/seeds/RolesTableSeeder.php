<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'description' => 'Administrador',
            'status' => '1',
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'description' => 'Usuario',
            'status' => '1',
        ]);
    }
}