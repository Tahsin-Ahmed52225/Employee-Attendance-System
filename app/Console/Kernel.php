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
            $not_checkedout =   DB::table('timesheet')->whereDate('check_in', now())->where('check_out', null)->get();
            foreach ($not_checkedout as $not_checkedout_user) {
                DB::table('timesheet')->where('id', $not_checkedout_user->id)->update(['check_out' => date('Y-m-d H:i:s')]);
                DB::table('timesheet')->where('id', $not_checkedout_user->id)->update(['status' => 'Pending']);
            }

            $employees = DB::table('users')->where('role', 'employee')->get();
            foreach ($employees as $person) {

                //Check if employee in the office
                $attended = DB::table('timesheet')->whereDate('created_at', now())->where('user_id', $person->id)->get();
                //   dd($attended);
                //Check if employee in leave
                if (count($attended) == 0) {
                    //Check if today is holiday
                    $office_holidays = DB::table('holiday')
                        ->where(function ($query) {
                            $query->where('days', 1)
                                ->whereDate('start_date', '=', now()->toDateString());
                        })
                        ->orWhere(function ($query) {
                            $query->where('days', '>', 1)
                                ->whereDate('start_date', '<=', now()->toDateString())
                                ->whereDate('end_date', '>=', now()->toDateString());
                        })
                        ->get();
                    //  dd($office_holidays);
                    if (count($office_holidays) == 0) {
                        $leave = DB::table('leave_description')
                            ->where('user_id', $person->id)
                            ->where('leave_status', 'accepted')
                            ->where(function ($query) {
                                $query->where('leave_days', 1)
                                    ->whereDate('leave_starting_date', '=', now()->toDateString());
                            })
                            ->orWhere(function ($query) {
                                $query->where('leave_days', '>', 1)
                                    ->whereDate('leave_starting_date', '<=', now()->toDateString())
                                    ->whereDate('leave_ending_date', '>=', now()->toDateString());
                            })
                            ->get();
                        //Check if employee in home office
                        $home_office = DB::table('homeoffice')->where('user_id',  $person->id)
                            ->where('ho_status', 'accepted')
                            ->where(function ($query) {
                                $query->where('ho_days', 1)
                                    ->whereDate('ho_starting_date', '=', now()->toDateString());
                            })
                            ->orWhere(function ($query) {
                                $query->where('ho_days', '>', 1)
                                    ->whereDate('ho_starting_date', '<=', now()->toDateString())
                                    ->whereDate('ho_ending_date', '>=', now()->toDateString());
                            })
                            ->get();
                        if (count($home_office) == 0) {
                            if (count($leave) == 0) {
                                DB::table('timesheet')->insert(['user_id' => $person->id, 'check_in' => date('1000-01-01 00:00:00'), 'check_out' => null, 'total_time' => null, 'status' => 'Absent', 'created_at' => now()]);
                            }
                        }
                    }
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
