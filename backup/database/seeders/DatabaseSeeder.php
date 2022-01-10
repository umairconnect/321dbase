<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupStatusesTableSeeder::class);
        $this->call(AdminMessagesTableSeeder::class);
        $this->call(OperatorRolesTableSeeder::class);
        $this->call(MasterAdminsTableSeeder::class);
    }
}
