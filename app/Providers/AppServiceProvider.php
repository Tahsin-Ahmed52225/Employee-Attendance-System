<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}
