<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Admin_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'admin',
            'role' => 'admin',
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
    }
}
