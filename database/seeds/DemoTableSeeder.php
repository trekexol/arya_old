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
            'code_rif' => '003548625-9',
            'razon_social' => 'Empresa DEMO ARYA',
            'period' => 2021,
            'phone' => '04242013215',
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

        DB::table('professions')->insert([
            'name' => 'Administrador',
            'description' => 'Supervisa el area administrativa',
            'status' => '1',
        ]);
        DB::table('professions')->insert([
            'name' => 'Secretaria',
            'description' => 'Se encarga de la parte administrativa',
            'status' => '1',
        ]);
        DB::table('positions')->insert([
            'name' => 'Ingeniero',
            'description' => 'Se encarga del sistema',
            'status' => '1',
        ]);
        DB::table('positions')->insert([
            'name' => 'Contador',
            'description' => 'Se encarga de las finanzas',
            'status' => '1',
        ]);

        DB::table('unit_of_measures')->insert([
            'code' => 'Kgs',
            'description' => 'Kilogramos',
            'status' => '1',
        ]);
        DB::table('unit_of_measures')->insert([
            'code' => 'Lts',
            'description' => 'Litros',
            'status' => '1',
        ]);
        DB::table('modelos')->insert([
            'description' => 'Chevrolet',
            'status' => '1',
        ]);
        DB::table('modelos')->insert([
            'description' => 'Toyota',
            'status' => '1',
        ]);
        DB::table('colors')->insert([
            'description' => 'Negro',
            'status' => '1',
        ]);
        DB::table('colors')->insert([
            'description' => 'Blanco',
            'status' => '1',
        ]);
        DB::table('transports')->insert([
            'modelo_id' => 1,
            'color_id' => 1,
            'user_id' => 1,
            'type' => 'Carro',
            'placa' => 'ABF22N',
            'status' => '1',
        ]);
        DB::table('segments')->insert([
            'id' => 1,
            'description' => 'Bebidas',
            'status' => '1',
        ]);
        DB::table('segments')->insert([
            'id' => 2,
            'description' => 'Alimentos',
            'status' => '1',
        ]);
        DB::table('subsegments')->insert([
            'id' => 1,
            'segment_id' => 1,
            'description' => 'Refrescos',
            'status' => '1',
        ]);
        DB::table('subsegments')->insert([
            'id' => 2,
            'segment_id' => 2,
            'description' => 'Lata',
            'status' => '1',
        ]);
        DB::table('salary_types')->insert([
            'id' => 1,
            'name' => 'Alto',
            'description' => '600 a 800',
            'status' => '1',
        ]);
        DB::table('salary_types')->insert([
            'id' => 2,
            'name' => 'Medio',
            'description' => '400 a 600',
            'status' => '1',
        ]);
       
        DB::table('comision_types')->insert([
            'description' => 'Comision 1',
            'status' => '1',
        ]);

        DB::table('branches')->insert([
            'company_id' => 1,
            'parroquia_id' => 10111,
            'description' => 'Sucursal Principal',
            'direction' => 'Chacaito',
            'phone' => '0212-7651562',
            'phone2' => '0212-7651569',
            'person_contact' => 'Nestor',
            'phone_contact' => '0414-2351562',
            'observation' => 'Ninguna',
            'status' => '1',
        ]);

        DB::table('academiclevels')->insert([
            'name' => 'Licenciado',
            'description' => 'Graduado Universitario',
            'status' => '1',
        ]);
        DB::table('academiclevels')->insert([
            'name' => 'Bachiller',
            'description' => 'Finalizo Bachillerato',
            'status' => '1',
        ]);
        DB::table('employees')->insert([
            'position_id' => 1,
            'salary_types_id' => 1,
            'profession_id' => 1,
            'estado_id' => 1,
            'municipio_id' => 101,
            'parroquia_id' => 10102,
            'branch_id' => 1,
            'id_empleado' => '26.396.591',
            'nombres' => 'Empleado',
            'apellidos' => 'Bachiller',
            'fecha_ingreso' => '2021-04-01',
            'fecha_nacimiento' => '1997-09-09',
            'direccion' => 'Fuerzas Armadas',
            'monto_pago' => 1561651156.10,
            'email' => 'cefreitas.16@gmail.com',
            'telefono1' => '0414 236-1595',
            'acumulado_prestaciones' => 0,
            'acumulado_utilidades' => 0,
            'amount_utilities' => 'Ma',
            'status' => '1',
        ]);
    }
}
