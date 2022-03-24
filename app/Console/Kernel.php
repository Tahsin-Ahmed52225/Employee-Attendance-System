<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Helpers;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            //Check out all the non check out users

            $not_checkedout =   DB::table('timesheet')->whereDate('created_at', now())->where('check_out', null)->get();
            foreach ($not_checkedout as $not_checkedout_user) {
                DB::table('timesheet')->where('id', $not_checkedout_user->id)->update(['check_out' => date('Y-m-d H:i:s')]);
                DB::table('timesheet')->where('id', $not_checkedout_user->id)->update(['status' => 'Pending']);
            }

            //Check any employee is absent or not
            $employees = DB::table('users')->where('role', 'employee')->get();
            foreach ($employees as $person) {
                $check_in = DB::table('timesheet')->whereDate('created_at', now())->where('user_id', $person->id)->where('check_in', null)->first();
                if (!$check_in) {
                    DB::table('timesheet')->insert(['user_id' => $person->id, 'check_in' => date('1000-01-01 00:00:00'), 'check_out' => null, 'total_time' => null, 'status' => 'Absent', 'created_at' => now()]);
                }
            }
        })->everyMinute();
        // ->dailyAt(Helpers::settings('office_time_ends'));
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
