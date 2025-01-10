<?php

Route::middleware(['auth','url_redirect', 'redirect_if_not_authenticated'])
    ->as('technision.')
    ->prefix('technision')
    ->group(function () {    

        Route::get('/dashboard',[App\Http\Controllers\Technician\HomeController::class,'index'])->name('dashboard');
        Route::post('/update/profile',[App\Http\Controllers\Technician\HomeController::class,'update_profile'])->name('update.profile');
        Route::get('/issue/tickets',[App\Http\Controllers\Technician\HomeController::class,'issue_tickets'])->name('issue.tickets');
        Route::get('/issue/ticket/edit/{id}',[App\Http\Controllers\Technician\HomeController::class,'edit_ticket'])->name('issue.ticket.edit');

    });