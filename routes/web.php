<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::resource('parking', 'ParkingsController');
Route::get('parking', 'ParkingsController@check')->name('parking.check');

// report routes
//Route::get('payment-report', 'ReportGeneratorController@payment');
//Route::get('message-report', 'ReportGeneratorController@message');

//template report route
//Route::get('template-report', 'ReportGeneratorController@template');

//Route::get('Resavation-report', 'ReportGeneratorController@ReserveSlot');

//Feedback-report

//Route::get('Feedback-report', 'ReportGeneratorController@FeedbackReop');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z]+)?');
