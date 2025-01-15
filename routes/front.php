<?php
Route::get('/property/details/{slug}',[App\Http\Controllers\Front\HomeController::class,'property_details'])->name('property.details');

//Advance Search 

Route::post('/advance/search',[App\Http\Controllers\Front\HomeController::class,'advance_search'])->name('advance.search');

Route::get('property/list',[App\Http\Controllers\Front\HomeController::class,'properties_list'])->name('properties.list');
Route::get('booking/success',[App\Http\Controllers\BookingController::class,'booking_success'])->name('booking.success');