<?php

// Route::group( [ "middleware" => [ "auth", "redirect_if_not_authenticated" ], "as" => "admin.", "prefix" => "admin", "namespace" => "Admin" ] , function () {
//     Route::get('/dashboard',[App\Http\Controllers\Admin\HomeController::class,'index'])->name('dashboard');
// });

Route::middleware(['auth', 'redirect_if_not_authenticated'])
    ->as('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class,'index'])->name('dashboard');
        // Landlord List
        Route::get('/landlord/list', [App\Http\Controllers\Admin\HomeController::class,'landlord_list'])->name('landlord.list');
        //tenant list
        Route::get('/tenant/list', [App\Http\Controllers\Admin\HomeController::class,'tenant_list'])->name('tenant.list');
        // 
        Route::get('/properties', [App\Http\Controllers\Admin\HomeController::class,'properties'])->name('properties');
        //Approve Properties Status
        Route::get('/properties/update/status/{id}/{status}',[App\Http\Controllers\Admin\HomeController::class,'property_approve'])->name('properties.approve');
        //Property Details 
        Route::get('properties/{slug}',[App\Http\Controllers\Admin\HomeController::class,'property_details'])->name('property.details');
        //Tenant Enquiries Json
        Route::get('property/enquiries/{id}',[App\Http\Controllers\Admin\HomeController::class,'tenant_quries'])->name('property.enquiries');
        Route::get('property/enquiry/{id}',[App\Http\Controllers\Admin\HomeController::class,'single_quries'])->name('property.enquiry');

        //Tenant Invoices for Admin 

        Route::get('booking/tenant/invoices/{id}',[App\Http\Controllers\Admin\HomeController::class,'tenant_invoices'])->name('booking.tenant.invoices');

        // Pay Tenant Invoice 
        Route::get('booking/tenant/invoices/pay/{id}',[App\Http\Controllers\Admin\HomeController::class,'tenant_invoice_pay'])->name('booking.tenant.invoice.pay');

        //Start Landlord Contract 
        Route::post('booking/labdlord/contract/start',[App\Http\Controllers\Admin\HomeController::class,'start_lanlord_contract'])->name('landlord.contract.start');

        //Tenant Contract Start By Admin

        Route::post('/property/tenant/booking/start',[App\Http\Controllers\Admin\HomeController::class,'tenant_booking_start'])->name('property.tenant.booking.start');

        Route::get('/property/types/list',[App\Http\Controllers\Admin\HomeController::class,'type_index'])->name('property.types.list');
        Route::get('/property/types/create',[App\Http\Controllers\Admin\HomeController::class,'create_type'])->name('property.types.create');
        Route::post('/property/types/store',[App\Http\Controllers\Admin\HomeController::class,'store_type'])->name('property.types.store');
        Route::get('/property/types/edit/{id}',[App\Http\Controllers\Admin\HomeController::class,'edit_type'])->name('property.types.edit');
        Route::post('/property/types/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'update_type'])->name('property.types.update');
        Route::post('/property/types/delete/{id}',[App\Http\Controllers\Admin\HomeController::class,'delete_type'])->name('property.types.delete');

        Route::get('/province/json/{id}',[App\Http\Controllers\Admin\HomeController::class,'province_json'])->name('province.json');
        //Technision CURD Operation
        Route::get('/user/list',[App\Http\Controllers\Admin\HomeController::class,'technision_list'])->name('user.list');
        Route::get('/user/create',[App\Http\Controllers\Admin\HomeController::class,'technision_create'])->name('user.create');
        Route::post('/user/store',[App\Http\Controllers\Admin\HomeController::class,'technision_store'])->name('user.store');
        Route::get('/user/edit/{id}',[App\Http\Controllers\Admin\HomeController::class,'technision_edit'])->name('user.edit');
        Route::post('/user/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'technision_update'])->name('technision.update');
        Route::post('/user/delete/{id}',[App\Http\Controllers\Admin\HomeController::class,'technision_delete'])->name('user.delete');
        //Province CURD
        Route::get('/province/list',[App\Http\Controllers\Admin\HomeController::class,'province_list'])->name('province.list');
        Route::get('/province/create',[App\Http\Controllers\Admin\HomeController::class,'province_create'])->name('province.create');
        Route::post('/province/store',[App\Http\Controllers\Admin\HomeController::class,'province_store'])->name('province.store');
        Route::get('/province/edit/{id}',[App\Http\Controllers\Admin\HomeController::class,'province_edit'])->name('province.edit');
        Route::post('/province/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'province_update'])->name('province.update');
        Route::post('/province/delete/{id}',[App\Http\Controllers\Admin\HomeController::class,'province_delete'])->name('province.delete');

        //Property Features CURD 
        Route::get('/property/feature/list',[App\Http\Controllers\Admin\HomeController::class,'property_feature_list'])->name('property.feature.list');
        Route::get('/property/feature/create',[App\Http\Controllers\Admin\HomeController::class,'property_feature_create'])->name('property.feature.create');
        Route::post('/property/feature/store',[App\Http\Controllers\Admin\HomeController::class,'property_feature_store'])->name('property.feature.store');
        Route::get('/property/feature/edit/{id}',[App\Http\Controllers\Admin\HomeController::class,'property_feature_edit'])->name('property.feature.edit');
        Route::post('/property/feature/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'property_feature_update'])->name('property.feature.update');
        Route::post('/property/feature/delete/{id}',[App\Http\Controllers\Admin\HomeController::class,'property_feature_delete'])->name('property.feature.delete');

        //Booking Enquiry Operations 
        Route::get('/booking/enquiries',[App\Http\Controllers\Admin\HomeController::class,'booking_enquiries'])->name('booking.enquiries');
        Route::patch('/booking/enquiry/update',[App\Http\Controllers\Admin\HomeController::class,'update_booking_enquiry'])->name('booking.enquiry.update');
        Route::get('/booking/tenant/account/active/{e_id}',[App\Http\Controllers\Admin\HomeController::class,'active_tenant_account'])->name('account.active');
        //Start Contract
        Route::post('booking/start/contract',[App\Http\Controllers\Admin\HomeController::class,'start_contract'])->name('start.contract');
        //Booking Enquiry Invoices 

        Route::get('booking/enquiry/invoices/{e_id}',[App\Http\Controllers\Admin\HomeController::class,'enquiry_invoices'])->name('booking.enquiry.invoices');
        //Pay Invoice 
        Route::get('/booking/invoice/pay/{id}',[App\Http\Controllers\Admin\HomeController::class,'pay_invoice'])->name('invoice.pay');

        //Issue Tickets

       Route::get('/issue/tickets/{b_id}',[App\Http\Controllers\Admin\HomeController::class,'issue_tickets'])->name('issue.tickets');

       Route::get('issue/ticket/{id}',[App\Http\Controllers\Admin\HomeController::class,'issue_ticket'])->name('issue.ticket');
       Route::post('issue/ticket/assign',[App\Http\Controllers\Admin\HomeController::class,'assign_technision'])->name('ticket.assign');
       //Rented Properties 
       Route::get('rented/properties',[App\Http\Controllers\Admin\HomeController::class,'rented_properties'])->name('rented.properties'); 

       //Landlord Invoices 

       Route::get('/booking/labdlord/invoices/{b_id}',[App\Http\Controllers\Admin\HomeController::class,'landlord_invoices'])->name('landlord.invoices');
       Route::get('landlord/invoice/pay/{id}',[App\Http\Controllers\Admin\HomeController::class,'pay_landlord_invoice'])->name('landlord.invoice.pay');

       //Get Issue Ticket Receipt
       Route::get('/issue/ticket/resolve/{id}',[App\Http\Controllers\Admin\HomeController::class,'resolve_issue_add'])->name('issue.ticket.resolve');
       Route::post('/issue/ticket/resolve/post',[App\Http\Controllers\Admin\HomeController::class,'resolve_issue_post'])->name('issue.ticket.resolve.post');
       Route::post('/issue/ticket/pay',[App\Http\Controllers\Admin\HomeController::class,'issue_ticket_payment'])->name('issue.ticket.pay');
       Route::get('/issue/ticket/receipt/{id}',[App\Http\Controllers\Admin\HomeController::class,'issue_ticket_receipt'])->name('ticket.receipt');

       //Contract Termination 

       Route::post('/tenant/contract/terminate',[App\Http\Controllers\Admin\HomeController::class,'terminate_tenant_contract'])->name('tenant.contract.terminate'); 

       Route::post('/lanldord/contract/terminate',[App\Http\Controllers\Admin\HomeController::class,'landlord_tenant_contract'])->name('landlord.contract.terminate');

       //Commision Paid

       Route::post('tenant/booking/commision/pay',[App\Http\Controllers\Admin\HomeController::class,'pay_commision_amount'])->name('commission.pay');

       //Admin list
       Route::get('/admin/list',[App\Http\Controllers\Admin\HomeController::class,'admin_list'])->name('admin.list');

       //Edit Property 
       Route::get('property/edit/{id}',[App\Http\Controllers\Admin\HomeController::class,'edit_property'])->name('property.edit');
       Route::post('property/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'update_property'])->name('property.update');

       //All Landlord Contracts 
        Route::get('/landlord/contracts/all/{id}',[App\Http\Controllers\Admin\HomeController::class,'all_landlord_contract'])->name('landlord.contracts');
        //All Tenant Contracts 
        Route::get('/tenant/contracts/all/{id}',[App\Http\Controllers\Admin\HomeController::class,'all_tenant_contract'])->name('tenant.contracts');

        //Inspections 
        Route::get('inspections/list/{id}',[App\Http\Controllers\Admin\HomeController::class,'inspections'])->name('inspections.list');
        Route::post('inspections/store',[App\Http\Controllers\Admin\HomeController::class,'store_inspection'])->name('inspections.store');
        Route::post('inspections/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'inspection_update'])->name('inspections.update');
        Route::get('/inspection/delete/{id}',[App\Http\Controllers\Admin\HomeController::class,'inspection_delete'])->name('landlord.delete');
        //Inspection Contents 
        Route::get('/inspection/contents/{id}',[App\Http\Controllers\Admin\HomeController::class,'inspection_content'])->name('inspection.contents');

        //CMS CURD 
        Route::get('/cms/pages/list',[App\Http\Controllers\Admin\HomeController::class,'cms_pages_index'])->name('cms.pages.list');
        Route::get('/cms/pages/create',[App\Http\Controllers\Admin\HomeController::class,'cms_pages_create'])->name('cms.pages.create');
        Route::post('/cms/pages/post',[App\Http\Controllers\Admin\HomeController::class,'cms_pages_store'])->name('cms.pages.post');
        Route::get('/cms/pages/edit/{id}',[App\Http\Controllers\Admin\HomeController::class,'cms_pages_edit'])->name('cms.pages.edit');
        Route::post('/cms/pages/update/{id}',[App\Http\Controllers\Admin\HomeController::class,'cms_pages_update'])->name('cms.pages.update');
        Route::post('/cms/pages/delete/{id}',[App\Http\Controllers\Admin\HomeController::class,'cms_pages_delete'])->name('cms.pages.delete');

    });