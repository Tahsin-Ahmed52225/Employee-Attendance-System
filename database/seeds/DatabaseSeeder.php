<?php

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
        // $this->call(Admin_Seed::class);
        // $this->call(Employee_Seed::class);
        $this->call(Timesheet_Seed::class);
        // $this->call(Default_Seed::class);
    }
}
