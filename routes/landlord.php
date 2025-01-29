<?php

Route::middleware(['auth', 'redirect_if_not_authenticated'])
    ->as('landlord.')
    ->prefix('landlord')
    ->group(function () {

     Route::get('/dashboard',[App\Http\Controllers\Landlord\HomeController::class,'index'])->name('dashboard');
     Route::get('/edit/profile',[App\Http\Controllers\Landlord\HomeController::class,'edit_profile'])->name('edit.profile');
     Route::get('/provinces/json/{country_id}',[App\Http\Controllers\Landlord\HomeController::class,'provinces_json'])->name('provinces.json');
     Route::post('/update/profile',[App\Http\Controllers\Landlord\HomeController::class,'update_profile'])->name('update.profile');
     //Landlord Properties List
     Route::get('/properties',[App\Http\Controllers\Landlord\HomeController::class,'property_list'])->name('properties');
     Route::get('/properties/add',[App\Http\Controllers\Landlord\HomeController::class,'property_add'])->name('properties.add');
     Route::post('/properties/store',[App\Http\Controllers\Landlord\HomeController::class,'property_store'])->name('properties.store');
     Route::get('/properties/edit/{id}',[App\Http\Controllers\Landlord\HomeController::class,'property_edit'])->name('properties.edit');
     Route::post('/properties/update/{id}',[App\Http\Controllers\Landlord\HomeController::class,'property_update'])->name('properties.update');
     Route::get('/properties/delete/{id}',[App\Http\Controllers\Landlord\HomeController::class,'property_delete'])->name('properties.delete');
     //Booking Operations 
     Route::get('/booking/enquiries',[App\Http\Controllers\Landlord\HomeController::class,'booking_enquiries'])->name('booking.enquiries');
     Route::patch('/booking/enquiry/upload/file',[App\Http\Controllers\Landlord\HomeController::class,'upload_file_for_enquiry'])->name('upload.file');

     //Booking Invoices 
     Route::get('/booking/invoices/{e_id}',[App\Http\Controllers\Landlord\HomeController::class,'invoices_list'])->name('invoices.list');

     Route::get('/password/change',[App\Http\Controllers\Landlord\HomeController::class,'change_password'])->name('password.change');
     Route::post('/password/change/post',[App\Http\Controllers\Landlord\HomeController::class,'change_password_post'])->name('password.change.post');

     Route::get('/booked/properties',[App\Http\Controllers\Landlord\HomeController::class,'booked_properties'])->name('booked.properties');

     Route::patch('/upload/file',[App\Http\Controllers\Landlord\HomeController::class,'upload_file_for_enquiry'])->name('upload.file');

     Route::post('remov/image/',[App\Http\Controllers\Landlord\HomeController::class,'remove_property_image'])->name('property.remove.image');

    });
