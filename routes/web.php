<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home')->middleware('set_locale');
Auth::routes();
//Changing Languages 
Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'nl'])) {
        abort(400);
    }

    session(['locale' => $locale]);
 
    \Illuminate\Support\Facades\App::setLocale($locale);


    return redirect()->back();

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Booking Routes 
Route::post('/booking',[App\Http\Controllers\BookingController::class,'book_property'])->name('property.book');



require __DIR__.'/front.php';
require __DIR__.'/admin.php';
require __DIR__.'/landlord.php';
require __DIR__.'/tenant.php';
require __DIR__.'/technision.php';
