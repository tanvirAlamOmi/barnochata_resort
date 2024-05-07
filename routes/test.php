<?php

use App\Http\Controllers\TestController;

Route::group(['prefix' => 'test'], function () {
	Route::get('/booking-request-mail', [TestController::class, 'check_booking_request_mail']);
	Route::get('/booking-request-mail/{booking_no}', [TestController::class, 'check_booking_request_mail']);
});
