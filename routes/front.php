<?php

Route::get('/property/list',[App\Http\Controllers\Front\HomeController::class,'property_listing'])->name('property.listing');
Route::get('/property/details/{slug}',[App\Http\Controllers\Front\HomeController::class,'property_details'])->name('property.details');