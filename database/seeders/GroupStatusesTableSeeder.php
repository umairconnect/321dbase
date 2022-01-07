<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_statuses')->insert([
            [
                'id' => 1,
                'status' => 'active'
            ],
            [
                'id' => 2,
                'status' => 'attention'
            ],
            [
                'id' => 3,
                'status' => 'canceled'
            ],
            [
                'id' => 4,
                'status' => 'demo'
            ],
            [
                'id' => 5,
                'status' => 'new'
            ]
        ]);
    }
}
