<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
//Login route
Route::match(['get', 'post'], '/login', 'AuthController@tdgLogin')->name('login');


//Authentication routes
//Routes for Authenticated Users
Route::middleware('auth')->group(function () {
    ######Logout Route
    Route::get('/logout', 'AuthController@logout')->name("logout");
});

//Admin Routes
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
});
//Employee Routes
Route::prefix('employee')->name('employee.')->middleware(['auth', 'employee'])->group(function () {
    //Dashboard Route
    Route::match(['get', 'post'], '/dashboard', 'EmployeeDashboardController@view')->name('dashboard');
    //Profile Route
    Route::match(['get', 'post'], '/profile', 'EmployeeProfileController@view')->name('profile');
});
