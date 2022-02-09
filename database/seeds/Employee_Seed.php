<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Employee_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Ismail Hossain',
            'email' => 'ismail@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Web developer',
            'role' => 'employee',
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Joy Mojumder',
            'email' => 'joy@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Web developer',
            'role' => 'employee',
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Imran rahman',
            'email' => 'imran@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Web developer',
            'role' => 'employee',
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Rashed Rabbi',
            'email' => 'rashed@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Web developer',
            'role' => 'employee',
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mahbubur Rahman',
            'email' => 'mahbub@tdg.com',
            'number' => '1111111',
            'image' => null,
            'position' => 'Manager',
            'role' => 'employee',
            'stage' => 1,
            'password' => Hash::make('11223344'),
        ]);
    }
}
