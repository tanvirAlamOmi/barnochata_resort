<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\CartController;

Route::get('/clear-parasites', function () {
    $exitCode = Artisan::call('optimize:clear');
    return back();
});

// Route::get('/', function () {
//     return view('web.index');
// });

Route::get('/', [WebController::class, 'home'])->name('/');
Route::get('home', [WebController::class, 'home'])->name('home');
Route::get('rooms-&-suits', [WebController::class, 'rooms_suits'])->name('rooms-&-suits');
Route::get('gallery', [WebController::class, 'gallery'])->name('gallery');
Route::get('contact', [WebController::class, 'contact'])->name('contact');
Route::get('faq', [WebController::class, 'faq'])->name('faq');
Route::get('terms-&-conditions', [WebController::class, 'terms_conditions'])->name('terms-&-conditions');
Route::get('privacy-policy', [WebController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('directors', [WebController::class, 'directors'])->name('directors');
Route::get('outdoors/{slug}', [WebController::class, 'outdoors'])->name('outdoors');
Route::get('service-&-facilities/{slug}', [WebController::class, 'service_facilities'])->name('service-&-facilities');

Route::get('payment', [WebController::class, 'payment'])->name('payment');
Route::post('search-booking', [WebController::class, 'search_booking'])->name('search-booking');

// booking routes
Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('add-to-cart');
Route::post('remove-from-cart', [CartController::class, 'remove_from_cart'])->name('remove-from-cart');
Route::post('update-cart-addons', [CartController::class, 'update_cart_addons'])->name('update-cart-addons');
Route::get('book-now', [WebController::class, 'book_now'])->name('book-now');
Route::get('room-details/{slug}',[WebController::class, 'room_details'])->name('room-details');
Route::post('confirm-booking', [WebController::class, 'confirm_booking'])->name('confirm-booking');
Route::post('submit-confirmation', [WebController::class, 'submit_confirmation'])->name('submit-confirmation');
// Route::get('booking-successfull', [WebController::class, 'submit_confirmation'])->name('booking-successfull');

Route::get('booking-successfull', function () {
    return view('web.booking-successfull');
})->name('booking-successfull');

Route::get('/design-samples', [WebController::class, 'design_samples'])->name('design-samples');
Route::view('details-1', 'web.details_1')->name('details-1');
Route::view('details-2', 'web.details_2')->name('details-1');
Route::view('details-3', 'web.details_3')->name('details-1');

Route::post('submit-message', [WebController::class, 'submit_message'])->name('submit-message');

Auth::routes();

// dashboard routes

require __DIR__ . '/dashboard.php';
require __DIR__ . '/test.php';
