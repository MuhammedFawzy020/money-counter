<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');

    
});


Route::get('/home' ,'App\Http\Controllers\HomeController@home')->name('home');

// Registration Routes
Route::get('register-form', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register-form');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');


// Password Reset Routes
// Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');




// Login Routes
Route::get('login-form', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login-form');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');



//الواردات
Route::get('/imports' ,'App\Http\Controllers\ImportsController@index')->name('imports-index');
// Route::get('/imports-create' ,'App\Http\Controllers\ImportsController@create')->name('imports-create');
Route::post('/imports-store' ,'App\Http\Controllers\ImportsController@store')->name('imports-store');
Route::post('/imports-update' ,'App\Http\Controllers\ImportsController@update')->name('imports-update');
Route::get('/imports-delete/{id}' ,'App\Http\Controllers\ImportsController@delete')->name('imports-delete');




//الصادرات
Route::get('/exports' ,'App\Http\Controllers\ExportsController@index')->name('exports-index');
// Route::get('/imports-create' ,'App\Http\Controllers\ImportsController@create')->name('imports-create');
Route::post('/exports-store' ,'App\Http\Controllers\ExportsController@store')->name('exports-store');
Route::post('/exports-update' ,'App\Http\Controllers\ExportsController@update')->name('exports-update');
Route::get('/exports-delete/{id}' ,'App\Http\Controllers\ExportsController@delete')->name('exports-delete');


