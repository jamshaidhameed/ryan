<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Provinces;
use App\Models\User;
use App\Models\Properties;
use App\Models\BookingEnquiries;
use App\Models\Invoices;
use App\Mail\PropertyAddMail;
use App\Models\LandlordContracts;
use Auth;
use File; 

class HomeController extends Controller
{
    public function index(){
        
        return view('landlord.index');
    }

    public function edit_profile(){

        return view('landlord.edit_profile');
    }
    public function provinces_json($country_id){
        return response()->json(Provinces::where('country_id',$country_id)->get());
    }
    public function update_profile(Request $request){
        $request->validate(
            [
                'first_name' =>'required|string|max:255',
                'last_name' =>'required|string|max:255',
                'gender' => 'required',
                'email' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'country_id' => 'required',
                'province_id' => 'required',
                'phone' => 'required',
                'city' => 'required|string|max:255',
                'postcode' => 'required|string|max:255',
                'street_address' => 'nullable|string|max:255'
            ]
            );
        $image = $request->file;

        $landlord = User::find(Auth::user()->id);
        $new_name = '';

        if ($image != NULL) {

        $new_name = rand().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('upload/landlord'),$new_name);

        if(File::exists(public_path('upload/landlord/').$landlord->image)) {
            File::delete(public_path('upload/landlord/').$landlord->image);
        }


        }else{

            $new_name = $landlord->image;
        }

        User::where('id',$landlord->id)->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'company_name' => $request->company_name,
                'country_id' => $request->country_id,
                'province_id' => $request->province_id,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'city' => $request->city,
                'street_address' => $request->street_address,
                'email' => $request->email,
                'photo' => $new_name
                
            ]
            );

            session()->flash('success','Profile Updated Successfully');

        return redirect()->route('landlord.dashboard');
        
    }

    //Properties List
    public function property_list(){

        $property_list = Properties::where('user_id',Auth::user()->id)->paginate(10);

        return view('landlord.properties.index',compact('property_list'));
    }
    public function property_add(){
        return view('landlord.properties.create');
    }
    public function property_store(Request $request){
        $request->validate(
            [
                'title_en' => 'required|string|max:255',
                'title_nl' => 'required|string|max:255',
                'price' => 'required',
                'property_type_id' => 'required',
                'street_address' => 'required',
                'city' => 'required',
                'postcode' => 'required',
                'contract_period' => 'required'
            ]
            );
        $property_images = $request->property_images;
        $features = $request->features;
        $feature_images = $request->feature_images;

        // Generating Slug 
        $slug = Str::slug($request->title_en);

        $if_exist = Properties::where('slug',$slug)->get();

        if (count($if_exist) > 0) {
            $slug = $slug.'-'.Str::random(4);
        }

        $property_images_arr = array();
        $feature_images_arr = array();
        // Uploading Property Images
         if (!empty($property_images) && count($property_images) > 0) {

             $old_images = !empty($property_info->property_image) ? explode(",",$property_info->property_image) : array();

             foreach ($old_images as $ol_img) {
                if(File::exists(public_path('upload/property').$ol_img)) {
                    File::delete(public_path('upload/property').$ol_img);
                }
             }
            
            
            foreach ($property_images as $image) {

                $new_name = rand().'.'.$image->getClientOriginalExtension();
                
                $image->move(public_path('upload/property'),$new_name);
                array_push($property_images_arr,$new_name);
            }
         }
        // 

        //uploading Feature Images

        if (!empty($feature_images) && count($feature_images) > 0) {

            $old_images = !empty($property_info->feature_image) ? explode(",",$property_info->feature_image) : array();

             foreach ($old_images as $ol_img) {
                if(File::exists(public_path('upload/property/feature').$ol_img)) {
                    File::delete(public_path('upload/property/feature').$ol_img);
                }
             }
            
           foreach ($feature_images as $image) {
              $new_name = rand().'.'.$image->getClientOriginalExtension();
                
                $image->move(public_path('upload/property/feature'),$new_name);
                array_push($feature_images_arr,$new_name);
           }
        }

        $property_code = '';

        do{
            $v_code = rand(1000000,123456789);
            $property_code = $v_code;

            $exist = Properties::where('property_code',$property_code)->get();

        }while(count($exist) !=0);



     $property =    Properties::create(
            [
                'title_en' => $request->title_en,
                'description_en' => $request->description_en,
                'slug' => $slug,
                'property_code' => $property_code,
                'price' => $request->price,
                'contract_period' => $request->contract_period,
                'property_type_id' => $request->property_type_id,
                'user_id' => Auth::user()->id,
                'province_id' => $request->province_id,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'street_address' => $request->street_address,
                'status' => 0,
                'features' => !empty($request->features) && count($request->features) > 0 ? implode(",",$request->features) : '',
                'available_from' => !empty($request->available_from) ? date_format(date_create($request->available_from),'Y-m-d') : '',
                'area' => $request->area,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'kitchens' => $request->kitchens,
                'garages' => $request->garages,
                'parkings' => $request->parkings,
                'toilets' => $request->toilets,
                'title_nl' => $request->title_nl,
                'description_nl' => $request->description_nl,
                'feature_image' => !empty($feature_images_arr) && count($feature_images_arr) > 0 ? implode(",",$feature_images_arr) : '',
                'property_image' => !empty($property_images_arr) && count($property_images_arr) > 0 ? implode(",",$property_images_arr) : '',
                'youtube_url' => $request->youtube_url
            ]
            );

            // Send Email 

            $admins = User::where('role' ,'admin')->get();

            foreach ($admins as $key => $ad) {
                
                Mail::to($ad->email)->send(new PropertyAddMail(Auth::user()->first_name." ".Auth::user()->last_name,$property));
            }

        session()->flash('success','Property Created Successfully');

        return redirect()->route('landlord.properties');

    }
    public function property_edit($id){
        $property = Properties::find($id);
        
        return view('landlord.properties.create',compact('property'));
    }
    public function property_update(Request $request,string $id){
        $request->validate(
            [
                'title_en' => 'required|string|max:255',
                'title_nl' => 'required|string|max:255',
                'price' => 'required',
                'property_type_id' => 'required',
                'street_address' => 'required',
                'city' => 'required',
                'postcode' => 'required',
                'contract_period' => 'required'
            ]
            );

        $property_info = Properties::find($id);
        
        $property_images = $request->property_images;
        $features = $request->features;
        $feature_images = $request->feature_images;

        // Generating Slug 
        $slug = Str::slug($request->title_en);

        $if_exist = Properties::where('slug',$slug)->get();

        if (count($if_exist) > 0) {
            $slug = $slug.'-'.Str::random(4);
        }

        $property_images_arr = array();
        $feature_images_arr = array();
        // Uploading Property Images
         if (!empty($property_images) && count($property_images) > 0) {
            
            foreach ($property_images as $image) {

                $new_name = rand().'.'.$image->getClientOriginalExtension();
                
                $image->move(public_path('upload/property'),$new_name);
                array_push($property_images_arr,$new_name);
            }
         }
        // 

        //uploading Feature Images

        if (!empty($feature_images) && count($feature_images) > 0) {
            
           foreach ($feature_images as $image) {
              $new_name = rand().'.'.$image->getClientOriginalExtension();
                
                $image->move(public_path('upload/property/feature'),$new_name);
                array_push($feature_images_arr,$new_name);
           }
        }

        



        Properties::where('id',$id)->update(
            [
                'title_en' => $request->title_en,
                'description_en' => $request->description_en,
                'slug' => $slug,
                'property_code' => $slug,
                'price' => $request->price,
                'contract_period' => $request->contract_period,
                'property_type_id' => $request->property_type_id,
                'user_id' => Auth::user()->id,
                'province_id' => $request->province_id,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'street_address' => $request->street_address,
                'status' => 0,
                'features' => !empty($request->features) && count($request->features) > 0 ? implode(",",$request->features) : '',
                'available_from' => !empty($request->available_from) ? date_format(date_create($request->available_from),'Y-m-d') : '',
                'area' => $request->area,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'kitchens' => $request->kitchens,
                'garages' => $request->garages,
                'parkings' => $request->parkings,
                'toilets' => $request->toilets,
                'title_nl' => $request->title_nl,
                'description_nl' => $request->description_nl,
                'feature_image' => !empty($feature_images_arr) && count($feature_images_arr) > 0 ? implode(",",$feature_images_arr) : $property_info->feature_image,
                'property_image' => !empty($property_images_arr) && count($property_images_arr) > 0 ? implode(",",$property_images_arr) : $property_info->property_image,
                'youtube_url' => $request->youtube_url
            ]
            );

        session()->flash('success','Property Updated Successfully');

        return redirect()->route('landlord.properties');
    }
    public function property_delete($id){

        $property_info = Properties::find($id);

        $old_images = !empty($property_info->property_image) ? explode(",",$property_info->property_image) : array();

        foreach ($old_images as $ol_img) {
            if(File::exists(public_path('upload/property').$ol_img)) {
                File::delete(public_path('upload/property').$ol_img);
            }
        }

        //Featured Images 

        $old_images = !empty($property_info->feature_image) ? explode(",",$property_info->feature_image) : array();

             foreach ($old_images as $ol_img) {
                if(File::exists(public_path('upload/property/feature').$ol_img)) {
                    File::delete(public_path('upload/feature').$ol_img);
                }
             }

        $property_info->delete();

        session()->flash('success','Property Deleted Successfully');

        return redirect()->route('landlord.properties');
    }

    //My Property Booking Enquiries 

    public function booking_enquiries(){

        $my_enquiries = BookingEnquiries::landlordBookingEnquiries(Auth::user()->id);

        return view('landlord.bookings.enquiries.index',compact('my_enquiries'));
    }

    
    //Invoices

    public function invoices_list($e_id){
        
        $enquiry = BookingEnquiries::where('id',$e_id)->first();

        $invoices = Invoices::where(['tenant_contract_id' =>  $e_id,'invoice_type' => 'landlord invoice'])->with('property')->get();

        return view('landlord.bookings.invoices.index',compact('invoices','enquiry'));
    }

    //Change Password 
    public function change_password(){

        return view('landlord.change-password');
    }
    public function change_password_post(Request $request){

        $request->validate([
            'current_password' => 'required',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed'
            
        ]);

        $landlord = User::find(Auth::user()->id);

        if(!Hash::check($request->current_password,$landlord->password)){

            return back()->withErrors(['current_password' => 'Your Current Password is Incorrect'])->withInput();
        }

        $landlord->password = Hash::make($request->password);
        $landlord->save();


        session()->flash('success','Your Password has been successfully changed');

        return redirect()->back();


    }

   public function upload_file_for_enquiry(Request $request){
        $file = $request->tenant_uploaded_file;

        $contract = LandlordContracts::find($request->e_id);

        $file_name = rand().'.'.$file->getClientOriginalExtension();

        if(File::exists(public_path('upload/booking/').$contract->link)) {
                File::delete(public_path('upload/booking/').$contract->link);
            }

         $file->move(public_path('upload/booking'),$file_name);

         $contract->signed_at = date('Y-m-d H:i:s');

         $contract->save();

        session()->flash('success','File Uploaded Successfully');

        return redirect()->route('landlord.properties');
    }
}
