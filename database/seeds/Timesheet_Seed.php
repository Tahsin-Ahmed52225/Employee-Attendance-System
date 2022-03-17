<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class Timesheet_Seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Timer::class, 50)->create();
    }
}
