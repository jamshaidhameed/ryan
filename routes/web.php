<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

// Auth::routes(['register' => false]);
 Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Booking Routes 
Route::post('/booking',[App\Http\Controllers\BookingController::class,'book_property'])->name('property.book');


require __DIR__.'/front.php';
require __DIR__.'/admin.php';
require __DIR__.'/landlord.php';
require __DIR__.'/tenant.php';