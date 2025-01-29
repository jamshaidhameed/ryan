<?php
Route::get('/property/details/{slug}',[App\Http\Controllers\Front\HomeController::class,'property_details'])->name('property.details');

//Advance Search 

Route::post('/advance/search',[App\Http\Controllers\Front\HomeController::class,'advance_search'])->name('advance.search');
Route::get('contact/us',[App\Http\Controllers\Front\HomeController::class,'contact_us'])->name('contact.us');
Route::get('page/{slug}',[App\Http\Controllers\Front\HomeController::class,'cms_page'])->name('cms.page');

Route::get('property/list',[App\Http\Controllers\Front\HomeController::class,'properties_list'])->name('properties.list');
Route::get('booking/success',[App\Http\Controllers\BookingController::class,'booking_success'])->name('booking.success');


Route::post('/contact/use/post',[App\Http\Controllers\Front\HomeController::class,'contact_us_post'])->name('contact.use.post');
