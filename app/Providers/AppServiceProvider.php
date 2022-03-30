<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Getting pending leave application number
        view()->composer('admin.*', function ($view) {
            $pending_leave_application_count = \App\OfficeLeave::where('leave_status', '=', 'Pending')->count();
            $view->with('pending_leave_application_count', $pending_leave_application_count);
        });
        //Getting pedding home office application number
        view()->composer('admin.*', function ($view) {
            $pending_ho_application_count = \App\HomeOffice::where('ho_status', '=', 'Pending')->count();
            $view->with('pending_ho_application_count', $pending_ho_application_count);
        });
        //Getting pending list number
        view()->composer('*', function ($view) {
            $pending_list = \App\Timer::where('status', '=', 'Pending')->count();
            $view->with('pending_list', $pending_list);
        });
    }
}
