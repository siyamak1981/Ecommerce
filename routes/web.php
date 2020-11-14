<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change-password', 'App\Http\Controllers\HomeController@changepassword')->name('password.change');
Route::post('/update-password', 'App\Http\Controllers\HomeController@updatepassword')->name('password.update');
Route::get('/user/logout', 'App\Http\Controllers\HomeController@logout')->name('user.logout');

// // Admin Route
Route::get('/admin/home/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('admin', 'App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('admin.show');
Route::post('admin', 'App\Http\Controllers\Admin\Auth\LoginController@login')->name('admin.login');


// Route::get('password/confirm', 'App\Http\Controllers\Admin\Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
// Route::post('password/confirm', ' App\Http\Controllers\Admin\Auth\ConfirmPasswordController@confirm');
Route::post('admin/password/email', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::get('admin/password/reset/{token}', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
// Route::post('admin/password/reset', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');
Route::get('/admin/change/password','App\Http\Controllers\AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','App\Http\Controllers\AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'App\Http\Controllers\AdminController@logout')->name('admin.logout');

