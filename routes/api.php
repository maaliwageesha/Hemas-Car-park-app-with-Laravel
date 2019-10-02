<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('parking/details', 'ParkingsController@details')->name('parking.details');
Route::get('reserve/filter', 'ReservationController@filter')->name('reserve.filter');
Route::get('reserve/expire', 'ReservationController@checkReserveExpires')->name('reserve.checkReserveExpires');
Route::apiResources([
    'users' => 'API\UserController',
    'staff' => 'StaffController',
    'type' => 'TypeController',
    'parking' => 'ParkingsController',
    'reserve' => 'ReservationController',
    'complaint' => 'ComplaintController',
    'feedback' => 'FeedbackController',
    'message' => 'MessageController',
    'attendance' => 'AttendanceController',
    ]);
Route::post('parking/settled', 'ParkingsController@paimentSettled')->name('parking.paimentSettled');
Route::post('parking/check', 'ParkingsController@check')->name('parking.check');

Route::post('message/send', 'MessageController@send')->name('message.send');
Route::post('reserve/check', 'ReservationController@check')->name('reserve.check');
Route::get('payment', 'PaymentController@index')->name('payment.index');
Route::delete('payment/{id}', 'PaymentController@destroy')->name('payment.destroy');
Route::get('payment/filter', 'PaymentController@filter')->name('payment.filter');
Route::get('regular', 'StaffController@regular')->name('payment.regular');
Route::post('regular', 'StaffController@store_reg')->name('payment.store_reg');
Route::post('staff/check', 'StaffController@check')->name('staff.check');
//Route::post('staff/reserve', 'StaffController@resrve')->name('staff.reserve');
//Route::get('profile', 'API\UserController@profile');
//Route::put('profile', 'API\UserController@updateProfile');
//Route::get('findUser', 'StaffController@search');
//Route::get('findTemp', 'StaffController@tempSearch');
//Route::get('findPayment', 'PaymentController@search');
Route::get('findReservation', 'ReservationController@search');