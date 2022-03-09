<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::match(['get', 'post'], '/login', 'AuthController@tdgLogin')->name('login');



##############################################################   Auth Routes    ############################################################

Route::middleware('auth')->group(function () {
    ######Logout Route
    Route::get('/logout', 'AuthController@logout')->name("logout");
    //App:In & Out
    Route::post('/check-in', 'TimerController@checkIn')->name('check_in');
    Route::post('/check-out', 'TimerController@checkOut')->name('check_out');
});

##############################################################   Admin Routes    ############################################################

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    //Dashboard Route
    Route::match(['get', 'post'], '/dashboard', 'AdminDashboardController@view')->name('dashboard');
    //Add member Route
    Route::match(['get', 'post'], '/add-member', 'AdminAddMemberController@addMember')->name('add_member');
    Route::get('/view-member', 'AdminAddMemberController@viewMember')->name('view_member');
    Route::get('/delete-member', 'AdminAddMemberController@deleteMember')->name('delete_member');
    Route::get('/update-member', 'AdminAddMemberController@updateMember')->name('update_member');
    //Profile Route
    Route::get('/profile', 'AdminProfileController@view')->name('profile');
    Route::match(['get', 'post'], '/edit-profile', 'AdminProfileController@edit')->name('edit_profile');
    Route::post('/change-profile-image', 'AdminProfileController@changeProfile')->name('change_profile_image');
    //App:In & Out
    Route::match(['get', 'post'], '/in-and-out', 'TimerController@view')->name('in_and_out');
    Route::get('/view-timesheet', 'TimesheetController@view')->name('view_timesheet');
    //App:Leave
    Route::match(['get', 'post'], '/leave-list', 'AdminLeaveController@view')->name('leave_list');
    Route::get('/leave-request', 'AdminLeaveController@index')->name('leave_request');
    Route::post('/leave-request/{id}', 'AdminLeaveController@update')->name('leave_request_update');
    //App:Home Office
    Route::match(['get', 'post'], '/home-office-list', 'AdminHomeOfficeController@view')->name('ho_list');
    Route::get('/home-office-request', 'AdminHomeOfficeController@index')->name('ho_request');
    Route::post('/home-office-request/{id}', 'AdminHomeOfficeController@update')->name('ho_request_update');

    //App:Daily Report
    Route::get('/daily-report', 'AdminDailyUpdateController@index')->name('daily_report');
});

##############################################################   Employee Routes    ############################################################

Route::prefix('employee')->name('employee.')->middleware(['auth', 'employee'])->group(function () {
    //Dashboard Route
    Route::match(['get', 'post'], '/dashboard', 'EmployeeDashboardController@view')->name('dashboard');
    //Profile Route
    Route::match(['get', 'post'], '/profile', 'EmployeeProfileController@view')->name('profile');
    Route::match(['get', 'post'], '/edit-profile', 'EmployeeProfileController@edit')->name('edit_profile');
    Route::post('/change-profile-image', 'EmployeeProfileController@changeProfile')->name('change_profile_image');
    //App:Leave
    Route::match(['get', 'post'], '/leave-request', 'EmployeeLeaveController@index')->name('leave_request');
    //App:Home Office
    Route::match(['get', 'post'], '/home-office', 'EmployeeHomeOfficeController@index')->name('ho_request');
    //App:Daily Update
    Route::match(['get', 'post'], '/daily-update', 'EmployeeDailyUpdateController@index')->name('daily_update');
});
