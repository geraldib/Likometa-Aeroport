<?php

use Illuminate\Support\Facades\Route;

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

//Laravel Default Routes
Auth::routes(['verify' => true]);
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


//Confirm Booking
Route::get('/email/{id}/{confirmation}', 'NonUser\BookingController@confirmEmail');
Route::get('/user/email/{id}/{confirmation}', 'User\BookingController@confirmEmail');
Route::get('/office/email/{id}/{confirmation}', 'Office\BookingController@confirmEmail');

//After Confirm Routes:

//Download PDF
Route::get('/download/email/{id}', 'AfterBooking@downloadPdf');

//Delete Booking
Route::get('/delete/email/{id}/{confirmation}', 'AfterBooking@deleteFromEmail');


// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Home Controller
    Route::get('/home', 'HomeController@index')->name('home');

    // Free for all
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/about', function () { return view('about'); })->name('about');

    //Admin Routes
    Route::middleware('is.Admin')->group(function () {

        // Export to CSV
        Route::get('/export/users', 'Admin\ExportController@csvExport');
        Route::get('/export/today/bookings', 'Admin\ExportController@csvBookingsExport');

        //Users
        Route::get('/users', 'Admin\UserController@index')->name('users');
        Route::get('/users/{user}', 'Admin\UserController@show')->name('users.view');
        Route::get('/users/{user}/edit', 'Admin\UserController@edit')->name('users.edit');
        Route::put('/users/{user}', 'Admin\UserController@update')->name('users.update');
        Route::delete('/users/{user}/delete', 'Admin\UserController@delete')->name('users.delete');

        //Get Empty PLaces
        Route::post('/admin/get/emtpy/seats', 'Admin\BookingController@emptySeats');
        Route::post('/admin/get/new/time', 'Admin\BookingController@getNewTime');
        Route::post('/admin/get/city/intersections', 'Admin\BookingController@getIntersections');

        //Search Filter By Name
        Route::post('/admin/get/bookings/byname', 'Admin\BookingController@filterByName');

        //Bookings
        Route::get('/bookings', 'Admin\BookingController@index')->name('bookings');
        Route::get('/bookings/create', 'Admin\BookingController@create')->name('bookings.create');
        Route::post('/bookings/store', 'Admin\BookingController@store')->name('bookings.store');
        Route::get('/bookings/{booking}', 'Admin\BookingController@show')->name('bookings.view');
        Route::get('/bookings/{booking}/edit', 'Admin\BookingController@edit')->name('bookings.edit');
        Route::put('/bookings/{booking}', 'Admin\BookingController@update')->name('bookings.update');
        Route::delete('/bookings/{booking}/delete', 'Admin\BookingController@delete')->name('bookings.delete');

        //Offices
        Route::get('/offices', 'Admin\OfficeController@index')->name('offices');
        Route::get('/offices/create', 'Admin\OfficeController@create')->name('offices.create');
        Route::post('/offices/store', 'Admin\OfficeController@store')->name('offices.store');
        Route::get('/offices/{office}', 'Admin\OfficeController@show')->name('offices.view');
        Route::get('/offices/{office}/edit', 'Admin\OfficeController@edit')->name('offices.edit');
        Route::put('/offices/{office}', 'Admin\OfficeController@update')->name('offices.update');
        Route::delete('/offices/{office}/delete', 'Admin\OfficeController@delete')->name('offices.delete');

        //Trips
        Route::get('/trips', 'Admin\TripController@index')->name('trips');
        Route::get('/trips/create', 'Admin\TripController@create')->name('trips.create');
        Route::post('/trips/store', 'Admin\TripController@store')->name('trips.store');
        Route::get('/trips/{trip}/edit', 'Admin\TripController@edit')->name('trips.edit');
        Route::put('/trips/{trip}', 'Admin\TripController@update')->name('trips.update');
        Route::delete('/trips/{trip}/delete', 'Admin\TripController@delete')->name('trips.delete');

        //Intersections
        Route::get('/intersections', 'Admin\IntersectionController@index')->name('intersections');
        Route::get('/intersections/create', 'Admin\IntersectionController@create')->name('intersections.create');
        Route::post('/intersections/store', 'Admin\IntersectionController@store')->name('intersections.store');
        Route::get('/intersections/{intersection}/edit', 'Admin\IntersectionController@edit')->name('intersections.edit');
        Route::put('/intersections/{intersection}', 'Admin\IntersectionController@update')->name('intersections.update');
        Route::delete('/intersections/{intersection}/delete', 'Admin\IntersectionController@delete')->name('intersections.delete');

        //Roads
        Route::get('/roads', 'Admin\RoadController@index')->name('roads');
        Route::post('/roads/create', 'Admin\RoadController@create')->name('roads.create');
        Route::delete('/roads/{road}/delete', 'Admin\RoadController@delete')->name('roads.delete');

        //Grup Moshat
        Route::get('/ages', 'Admin\AgeController@index')->name('ages');
        Route::get('/ages/create', 'Admin\AgeController@create')->name('ages.create');
        Route::post('/ages/store', 'Admin\AgeController@store')->name('ages.store');
        Route::get('/ages/{age}/edit', 'Admin\AgeController@edit')->name('ages.edit');
        Route::put('/ages/{age}', 'Admin\AgeController@update')->name('ages.update');
        Route::delete('/ages/{age}/delete', 'Admin\AgeController@delete')->name('ages.delete');

    });

    Route::middleware('is.user')->group(function () {

        //Get Empty PLaces
        Route::post('/user/get/emtpy/seats', 'User\BookingController@emptySeats');
        Route::post('/user/get/new/time', 'User\BookingController@getNewTime');
        Route::post('/user/get/city/intersections', 'User\BookingController@getIntersections');

        // Bookings
        Route::get('/user/bookings', 'User\BookingController@index')->name('user.bookings');
        Route::get('/user/bookings/create', 'User\BookingController@create')->name('user.bookings.create');
        Route::get('/user/bookings/{booking}', 'User\BookingController@show')->name('user.bookings.show');
        Route::post('/user/bookings/store', 'User\BookingController@store')->name('user.bookings.store');
        Route::get('/user/{booking}/edit', 'User\BookingController@edit')->name('user.bookings.edit');
        Route::put('/user/bookings/{booking}', 'User\BookingController@update')->name('user.bookings.update');
        Route::delete('/user/bookings/{booking}/delete', 'User\BookingController@delete')->name('user.bookings.delete');

    });

    Route::middleware('is.office')->group(function () {

        //Get Empty PLaces
        Route::post('/office/get/emtpy/seats', 'Office\BookingController@emptySeats')->name('office.book');
        Route::post('/office/get/new/time', 'Office\BookingController@getNewTime');
        Route::post('/office/get/city/intersections', 'Office\BookingController@getIntersections');

        //Search Filter By Name
        Route::post('/office/get/bookings/byname', 'Office\BookingController@filterByName');

        // Bookings
        Route::get('/office/bookings', 'Office\BookingController@index')->name('office.bookings');
        Route::get('/office/bookings/create', 'Office\BookingController@create')->name('office.bookings.create');
        Route::get('/office/bookings/{booking}', 'Office\BookingController@show')->name('office.bookings.show');
        Route::post('/office/bookings/store', 'Office\BookingController@store')->name('office.bookings.store');
        Route::get('/office/{booking}/edit', 'Office\BookingController@edit')->name('office.bookings.edit');
        Route::put('/office/bookings/{booking}', 'Office\BookingController@update')->name('office.bookings.update');
        Route::delete('/office/bookings/{booking}/delete', 'Office\BookingController@delete')->name('office.bookings.delete');

    });

});

//Only Non Authenticated routes
Route::middleware('unidentified.user')->group(function () {
    Route::get('/', 'NonUser\BookingController@index')->name('outside.form');
    Route::post('/get/emtpy/seats', 'NonUser\BookingController@emptySeats');
    Route::post('/get/new/time', 'NonUser\BookingController@getNewTime');
    Route::post('/get/city/intersections', 'NonUser\BookingController@getIntersections');
    Route::post('/outside/book/create', 'NonUser\BookingController@store')->name('outside.store');
});


