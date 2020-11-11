<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change-password','App\Http\Controllers\HomeController@changepassword')->name('password.change');
Route::post('/change-password','App\Http\Controllers\HomeController@updatepassword')->name('password.update');
Route::get('/user/logout','App\Http\Controllers\HomeController@logout')->name('user.logout');

// Admin Route
Route::get('/admin/home/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('admin','App\Http\Controllers\Admin\LoginController@showLogin')->name('admin.show');
Route::post('admin','App\Http\Controllers\Admin\LoginController@login')->name('admin.login');
