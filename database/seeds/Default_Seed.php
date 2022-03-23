<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Default_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_settings')->insert([
            'name' => 'office_time_starts',
            'value' => '10:00:00',
        ]);
        DB::table('system_settings')->insert([
            'name' => 'office_time_ends',
            'value' => '18:00:00',
        ]);
        DB::table('system_settings')->insert([
            'name' => 'office_time_ends',
            'value' => '8',
        ]);
    }
}
