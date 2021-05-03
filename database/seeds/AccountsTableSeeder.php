<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'id' => 1,
            'code_one' => 1,
            'code_two' => 0,
            'code_three' => 0,
            'code_four' => 0,
            'period' => 0,
            'description' => 'ACTIVO',
            'type' => 'Debe',
            'level' => 1,
            'balance_previus' => 237258306.16,
            'status' => '1',
        ]);
        
    }
}
