<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperatorRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operator_roles')->insert([
            [
                'role_name' => 'Sales',
                'role_description' => ''
            ]
        ]);
    }
}
