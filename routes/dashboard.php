<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Settings\MenuController;
use App\Http\Controllers\Dashboard\Settings\PageController;
use App\Http\Controllers\Dashboard\Settings\SectionController;
use App\Http\Controllers\Dashboard\WebContent\MessageController;
use App\Http\Controllers\Dashboard\WebContent\NoticeController;
use App\Http\Controllers\Dashboard\WebContent\TextContentController;
use App\Http\Controllers\Dashboard\WebContent\ImageContentController;
use App\Http\Controllers\Dashboard\WebContent\FileContentController;
use App\Http\Controllers\Dashboard\WebContent\VideoContentController;
use App\Http\Controllers\Dashboard\DataContent\AddonsController;
use App\Http\Controllers\Dashboard\DataContent\FacilityController;
use App\Http\Controllers\Dashboard\DataContent\RoomController;
use App\Http\Controllers\Dashboard\DataContent\PackageController;
use App\Http\Controllers\Dashboard\DataContent\BookingController;
use App\Http\Controllers\Dashboard\DataContent\GuestController;

Route::group(['prefix' => 'dashboard','middleware' => ['auth', 'dashboard']], function () {
	Route::get('/index', [DashboardController::class, 'dashboard'])->name('dashboard');
	Route::get('/app-info', [DashboardController::class, 'app_info'])->name('app-info');
	Route::post('/app-info', [DashboardController::class, 'app_info_update'])->name('app-info.update');
	Route::resource('users', UserController::class);
	Route::resource('menus', MenuController::class);
	Route::resource('pages', PageController::class);
	Route::resource('sections', SectionController::class);
	Route::resource('text-contents', TextContentController::class);
	Route::resource('image-contents', ImageContentController::class);
	Route::resource('file-contents', FileContentController::class);
	Route::resource('video-contents', VideoContentController::class);

	Route::post('sections/update-heading', [SectionController::class, 'update_heading'])->name('sections.update-heading');

	Route::post('image-contents/status/{id}', [ImageContentController::class, 'status'])->name('image-contents.status');

	Route::post('text-contents/status/{id}', [TextContentController::class, 'status'])->name('text-contents.status');

	Route::post('video-contents/status/{id}', [VideoContentController::class, 'status'])->name('video-contents.status');
	
	Route::resource('notices', NoticeController::class);
	Route::post('/notices/status', [NoticeController::class, 'status'])->name('notices.status');
	
	Route::resource('/messages', MessageController::class);
	Route::post('/messages/status', [MessageController::class, 'status'])->name('messages.status');
	
	Route::resource('/addons', AddonsController::class);
	Route::post('/addons/status', [AddonsController::class, 'status'])->name('addons.status');
	
	Route::resource('/facilities', FacilityController::class);
	Route::post('/facilities/status', [FacilityController::class, 'status'])->name('facilities.status');

	Route::resource('rooms', RoomController::class);
	Route::post('rooms/store-images', [RoomController::class, 'store_images'])->name('rooms.store-images');
	Route::post('rooms/delete-image', [RoomController::class, 'delete_image'])->name('rooms.delete-image');
	Route::resource('packages', PackageController::class);
	Route::post('/packages/status', [PackageController::class, 'status'])->name('packages.status');

	// bookings
	Route::get('bookings',[BookingController::class, 'bookings'])->name('bookings');
	Route::get('bookings/{booking_no}',[BookingController::class, 'show'])->name('bookings.show');
	Route::post('booking-response',[BookingController::class, 'booking_response'])->name('booking-response');
	Route::post('bookings/update-status',[BookingController::class, 'update_status'])->name('bookings.update-status');

	Route::resource('/guests', GuestController::class);
	Route::get('/guests/add-guest/{booking_id}', [GuestController::class, 'create'])->name('guests.add-guest');
});
