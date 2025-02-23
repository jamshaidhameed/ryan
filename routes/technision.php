<?php

Route::middleware(['auth','url_redirect', 'redirect_if_not_authenticated'])
    ->as('technision.')
    ->prefix('technision')
    ->group(function () {    

        Route::get('/dashboard',[App\Http\Controllers\Technician\HomeController::class,'index'])->name('dashboard');
        Route::get('/provinces/json/{country_id}',[App\Http\Controllers\Technician\HomeController::class,'provinces_json'])->name('provinces.json');
        Route::post('/update/profile',[App\Http\Controllers\Technician\HomeController::class,'update_profile'])->name('update.profile');
        Route::get('/issue/tickets',[App\Http\Controllers\Technician\HomeController::class,'issue_tickets'])->name('issue.tickets');
        Route::get('/issue/show/{id}',[App\Http\Controllers\Technician\HomeController::class,'view_issue'])->name('issue.show');
        Route::get('/issue/resolve/option/{id}',[App\Http\Controllers\Technician\HomeController::class,'issue_resolve_option'])->name('issue.resolve.option');
        Route::get('/issue/show/{id}',[App\Http\Controllers\Technician\HomeController::class,'view_issue'])->name('issue.show');
        Route::post('/issue/resolve',[App\Http\Controllers\Technician\HomeController::class,'resolve_issue'])->name('issue.resolve');
        Route::post('/issue/pay',[App\Http\Controllers\Technician\HomeController::class,'issue_invoice_pay'])->name('issue.invoice.pay');

        Route::get('/issue/receipt/download/{id}',[App\Http\Controllers\Technician\HomeController::class,'download_issue_receipt'])->name('issue.receipt.download');

     Route::get('/password/change',[App\Http\Controllers\Technician\HomeController::class,'change_password'])->name('password.change');
     Route::post('/password/change/post',[App\Http\Controllers\Technician\HomeController::class,'change_password_post'])->name('password.change.post');

     //Inspection List

     Route::get('/inspection_list',[App\Http\Controllers\Technician\HomeController::class,'inspection_list'])->name('inspection.list');
     Route::get('/inspection/{id}',[App\Http\Controllers\Technician\HomeController::class,'inspect'])->name('take.inspections');
     Route::post('inspection/form',[App\Http\Controllers\Technician\HomeController::class,'inspection_form_submit'])->name('inspection.form.submit');

     Route::get('/inspection/contents/json/',[App\Http\Controllers\Technician\HomeController::class,'inspection_content_json']);

     //Donwload Inspection 

     Route::get('/inspection/download/{id}',[App\Http\Controllers\Technician\HomeController::class,'donwload_inspection'])->name('inspection.download');

    });