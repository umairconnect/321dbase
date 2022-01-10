<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MasterAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_admins')->insert([
            [
                'name' => 'Marcos Bemquerer',
                'email' => 'admin@test.net',
                'username' => 'admin',
                'password' => Hash::make('123456')
            ]
        ]);
    }
}
