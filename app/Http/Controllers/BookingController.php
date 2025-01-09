<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\BookingEnquiries;
use App\Models\User;
use Session;
use Auth;
use URL;

class BookingController extends Controller
{
    public function book_property(Request $request){

        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'message' => 'required',
            ]
            );

        if(!empty(Auth::user()->id) && Auth::user()->role != 'tenant' ){

            return redirect()->back()->withErrors('you are not authorized to book property');
        }


        if (!empty(Auth::user()->id)) {
        
            BookingEnquiries::create(
                [
                    'tenant_id' => Auth::user()->id,
                    'property_id' => $request->property_id,
                    'message' =>$request->message,
                    'enquiry_no' => rand(10000,123456)
                ]
                );
            session()->flash('success', 'Booking Enquiry has been created successfully');
            return redirect()->route('tenant.booking.enquiries');
        }else{

            $old_data = User::where('email',$request->email)->first();
            $user_id = 0;

            if (!empty($old_data)) {
               $user_id = $old_data->id; 
            }else{

                $tenant = User::create(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'role' => 'tenant',
                    'status' => '0'
                ]
                );

              if (!empty($tenant)) {
                $user_id = $tenant->id;
              }
            }

         BookingEnquiries::create(
                [
                    'tenant_id' => $user_id,
                    'property_id' => $request->property_id,
                    'message' =>$request->message,
                    'enquiry_no' => rand(10000,123456)
                ]
                );
        session()->flash('success', 'Booking Enquiry has been created successfully');

        return redirect()->back();
            

        }

    }
}
