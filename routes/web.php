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
    Route::match(['get', 'post'], '/dashboard', 'AdminDashboardController@view')->name('login');
});
