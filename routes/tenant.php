<?php

Route::middleware(['auth','url_redirect', 'redirect_if_not_authenticated'])
    ->as('tenant.')
    ->prefix('tenant')
    ->group(function () {

     Route::get('/dashboard',[App\Http\Controllers\Tenant\HomeController::class,'index'])->name('dashboard');
     Route::get('/provinces/json/{country_id}',[App\Http\Controllers\Tenant\HomeController::class,'provinces_json'])->name('provinces.json');
     Route::post('/update/profile',[App\Http\Controllers\Tenant\HomeController::class,'update_user_profile'])->name('update.profile');
     Route::get('/booking/enquiries',[App\Http\Controllers\Tenant\HomeController::class,'booking_enquiries'])->name('booking.enquiries');
     Route::patch('/booking/enquiry/upload/file',[App\Http\Controllers\Tenant\HomeController::class,'upload_file_for_enquiry'])->name('upload.file');
     //Invoices List of a Property

     Route::get('booking/invoices/{e_id}',[App\Http\Controllers\Tenant\HomeController::class,'my_invoices'])->name('booking.invoices');

     //Complaints 
      Route::get('booking/property/complaints/{e_id}',[App\Http\Controllers\Tenant\HomeController::class,'my_complaints'])->name('booking.property.complaints');
      Route::get('booking/property/complaints/create/{e_id}',[App\Http\Controllers\Tenant\HomeController::class,'create_complaint'])->name('complaints.create');
      Route::post('booking/property/complaints/store',[App\Http\Controllers\Tenant\HomeController::class,'store_complaint'])->name('complaints.store');

      //Single Tenant Contract 
      Route::get('/booking/tenant/contract/{id}',[App\Http\Controllers\Tenant\HomeController::class,'single_tenant_contract'])->name('single.tenant.contract');

      Route::get('/password/change',[App\Http\Controllers\Tenant\HomeController::class,'change_password'])->name('change.password');
     Route::post('/password/change/post',[App\Http\Controllers\Tenant\HomeController::class,'change_password_post'])->name('password.change.post');

    });
