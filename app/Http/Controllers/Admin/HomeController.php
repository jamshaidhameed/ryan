<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Properties;
use App\Models\PropertyTypes;
use App\Models\Provinces;
use App\Models\User;
use App\Models\PropertyFeatures;
use App\Models\BookingEnquiries;
use App\Models\Invoices;
use App\Models\LandlordContracts;
use App\Models\TenantContracts;
use App\Models\IssueTickets;
Use App\Models\IssueTicketInvoices;
use App\Models\Inspections;
use App\Models\cms;
use App\Mail\TenantContract;
use App\Mail\UserRegister;
use App\Mail\LandlordInvoicePaid;
use Redirect;
use File;
use DateTime;
use DateInterval;
use Auth;

class HomeController extends Controller
{
    public function index(){
        
        return view('admin.dashboard');
    }
    //Landlord List
    public function landlord_list(){
        return view('admin.landlord_list');
    }
    // Tenant list
    public function tenant_list(){
        return view('admin.tenant_list');
    }
    // 
    public function properties(){

        return view('admin.properties.index');
    }
    //Update the Properties Status
    public function property_approve($id,$status){

        Properties::where('id',$id)->update(['status' => $status]);

        session()->flash('success','Property Status updated successfully');

        return redirect()->back();
    }

    //Property Details 
    public function property_details($slug){

        $property = Properties::where('slug',$slug)->with(['landlord','type'])->first();

        $landlord_contract = LandlordContracts::orderBy('id','desc')->where(['property_id' => $property->id,'terminated_on' => null,'expired_at' => ' > '. date('Y-m-d')])->first();
        $tenant_contract = TenantContracts::orderBy('id','desc')->where(['expired_at' => ' > '. date('Y-m-d')])->first();

        $t_contracts = DB::select("SELECT * FROM `tenant_contracts` WHERE property_id = ".$property->id." AND (expired_at >= '".date('Y-m-d')."' AND terminated_on IS NULL)");

        if (count($t_contracts) > 0) {
           $tenant_contract = $t_contracts[0]; 

        }else {
             $tenant_contract =null;
        }

        $l_contracts = DB::select("SELECT * FROM `landlord_contracts` WHERE expired_at >= '".date('Y-m-d')."' AND property_id = ".$property->id." AND terminated_on IS NULL");

        if (count($l_contracts) > 0) {
            
            $landlord_contract = $l_contracts[0];
        }else {
             $landlord_contract =null;
        }
        
        return view('admin.properties.detail',compact('property','landlord_contract','tenant_contract'));
        
    }

    //Tenant Quries in Json Format
    public function tenant_quries($id){

        $choosen = BookingEnquiries::orderBy('id','desc')->where(['property_id' => $id,'status' => 'selected'])->first();
        
        $enquiries = BookingEnquiries::where('property_id',$id)->with('tenant')->get();

        return response()->json( ['selected' => $choosen,'all' => $enquiries]);
    }

    //Invoices 

    public function tenant_invoices($id){

        $invoices = Invoices::where(['tenant_contract_id' => $id,'invoice_type' => 'tenant invoice'])->get();

        

        $invoice_list = array();

        foreach ($invoices as $key => $inc) {
            
            $invoice_list [] = [
                'id' => $inc->id,
                'invoice_number' => $inc->invoice_number,
                'invoice_type' => ucwords($inc->invoice_type),
                'month' => date_format(date_create($inc->from_date),'M').'-'.date_format(date_create($inc->from_date),'Y').'/'.date_format(date_create($inc->till_date),'M')."-".date_format(date_create($inc->till_date),'Y'),
                'status' => $inc->status,
                'amount' => number_format($inc->amount,2),
            ];
        }

        return response()->json($invoice_list);
    }

    //Pay Tenant Invoice 
    public function tenant_invoice_pay($id){

        $invoice = Invoices::Find($id);

        if (empty($invoice)) {
            
            return response()->json(['success' => false,'message' => 'Invoice not found']);
        }

        $invoice->status = 'paid';
        $invoice->paid_at = date('Y-m-d H:i:s');

        $invoice->save();

        return response()->json(['success' => true,'message' => 'Invoice Paid Successfully']);
    }

    //Start Landlord Contract

    public function start_lanlord_contract(Request $request){

        $request->validate(
            [
                'prop_id' => 'required',
                'contract_period' => 'required',
                'price' => 'required',
                'start_from' => 'required',
            ]
            );

            $property_price = $request->price;

            $start_date = date_format(date_create($request->start_from),'Y-m-d');
            $start_month = date_format(date_create($request->start_from),'m');
            $start_day = date_format(date_create($request->start_from),'d');
            $year = date_format(date_create($request->start_from),'Y');

            $contract_period = $request->contract_period - 1;
            $start_from = new DateTime($request->start_from);

            $next_four_months = $start_from->modify('+'.$contract_period." months");

            $file_name = rand().'-'.date("Y-m-d").'.pdf';

            $property = Properties::find($request->prop_id);

            $company_name = env('Business_Title');
            $landlord = User::find($property->user_id);
            $property_owner = !empty($landlord) ? $landlord->first_name." ".$landlord->last_name : '';
            
            $todays_date = date('F d, Y ');
            $contract_officer = Auth::user()->first_name." ".Auth::user()->last_name;

            $file =  Pdf::loadView('admin.bookings.enquiries.contract_files.landlord-contracts',compact('company_name','property_owner','property','todays_date','property_price'))->setOption('isHtml5arserEnabled',true)->setOption('isPhpEnabled',true)->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path()
            ])->save(public_path().'/upload/booking/'.$file_name);


        $contract_code = '';

         do{
                $v_code = rand(10000000,12345678);
                $contract_code = $v_code;

                $exist = LandlordContracts::where('contract_code',$contract_code)->get();

            }while(count($exist) !=0);

        $landlord_contract = LandlordContracts::create(
            [
                'property_id' => $request->prop_id,
                'contract_code' => $contract_code,
                'link' => $file_name,
                'price' => $request->price,
                'start_from' => date_format(date_create($request->start_from),'Y-m-d'),
                'contract_period' => $request->contract_period,
                'expired_at' => $next_four_months->format('Y-m-t H:i:s'),
                'created_by' => Auth::user()->id,
                ]
        );

        $current_month = new DateTime($request->strat_from);

        for ($i=0; $i <  (int) $request->contract_period; $i++) { 

                $c_month = $current_month;
                $now_month = $c_month->format('Y-m-d');
                // echo "C Month: ".$c_month->format('Y-m-d')."<br><br>";

                // echo "Current Month: ".$current_month->format('Y-m-d')."<br>";

                $next_month = $current_month->modify('+1 month');
                $noxt_month = $next_month->format('Y-m-d');
                // echo "Next Month : ".$next_month->format('Y-m-d')."<br><br>";

                
                
                Invoices::create(
                    [
                        'tenant_contract_id' => $landlord_contract->id,
                        'property_id' => $request->prop_id,
                        'amount' => $request->price,
                        'from_date' => $now_month,
                        'till_date' =>$noxt_month,
                        'invoice_number' => rand(10000000,12345678),
                        'invoice_type' => 'landlord invoice'
                    ]
                    );

                $current_month = $next_month;
        }

        $property_info = Properties::find($request->prop_id);
        $landlord_info = User::find($property_info->user_id);

        //Email Sent to Landlord
        Mail::to($landlord_info->email)->send(new TenantContract($landlord_info->first_name." ".$landlord_info->last_name,public_path().'/upload/booking/'.$file_name));

        //

        session()->flash('success', 'Landlord Contract Created Successfully');

        return redirect()->route('admin.property.details',$property_info->slug);
    }


    public function single_quries($id){

        $enquiry = BookingEnquiries::where('id',$id)->with(['tenant','property'])->first();

        // $landlord_contract = LandlordContracts::orderBy('id','desc')->where(['property_id' => $enquiry->property->id,'terminated_on' => null,'expired_at' => ' < '. date('Y-m-d')])->first();

        $l_contracts = DB::select("SELECT * FROM `landlord_contracts` WHERE expired_at >= '".date('Y-m-d')."' AND property_id = ".$enquiry->property_id." AND terminated_on IS NULL");

        $landlord_contract = null;

        if (count($l_contracts) > 0) {
            
            $landlord_contract = $l_contracts[0];
        }else {
             $landlord_contract =null;
        }



        return response()->json(['enquiry' => $enquiry,'landlord_contract' => $landlord_contract]);
    }

    //Start Booking for Tenant 

    public function tenant_booking_start(Request $request){
        $request->validate(
            [
                "e_id" => 'required',
                "property_id" => 'required',
                "tenant_id" => 'required',
                "contract_period" => 'required',
                "price" => 'required',
                "persons" => 'required',
                "start_from" => 'required',
                "commission_amount" => 'required',
                "first_name" => 'required',
                "email" => 'required',
                "last_name" => 'required',
            ]
            );

        
            $start_date = date_format(date_create($request->start_from),'Y-m-d');
            $start_month = date_format(date_create($request->start_from),'m');
            $start_day = date_format(date_create($request->start_from),'d');
            $year = date_format(date_create($request->start_from),'Y');

            $contract_period = $request->contract_period - 1;
            $start_from = new DateTime($request->start_from);

            $next_four_months = $start_from->modify('+'.$contract_period." months");

            $file_name = rand().'-'.date("Y-m-d").'.pdf';

            $company_name = env('Business_Title');
            $tenant = User::find($request->tenant_id);
            $tenant_name = !empty($tenant) ? $tenant->first_name." ".$tenant->last_name : '';
            $property = Properties::find($request->property_id);
            $todays_date = date('F d, Y ');
            $contract_officer = Auth::user()->first_name." ".Auth::user()->last_name;
            

            $file =  Pdf::loadView('admin.bookings.enquiries.contract_files.tenant-contracts',compact('company_name','tenant_name','property','todays_date','contract_officer'))->setOption('isHtml5arserEnabled',true)->setOption('isPhpEnabled',true)->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path()
        ])->save(public_path().'/upload/booking/'.$file_name);

         $commision_paid_at = null;
         
         if(!empty($request->commision_paid)){

            $commision_paid_at = date('Y-m-d');
         }

         $contract_code = '';

         $commission_verified_by = null;

         if (!empty($commision_paid_at)) {
            
            $commission_verified_by = Auth::user()->id;
         }

         do{
                $v_code = rand(10000000,12345678);
                $contract_code = $v_code;

                $exist = TenantContracts::where('contract_code',$contract_code)->get();

            }while(count($exist) !=0);

          $tenant_contract =   TenantContracts :: create(
                [
                    'property_id' => $request->property_id,
                    'contract_code' => $contract_code,
                    'user_id' => $request->tenant_id,
                    'price' => $request->price,
                    'start_from' => date_format(date_create($request->start_from),'Y-m-d H:i:s'),
                    'contract_period' => $request->contract_period,
                    'link' => $file_name,
                    'expired_at' => $next_four_months->format('Y-m-t H:i:s'),
                    'commission_amount' => $request->commission_amount,
                    'commission_paid_at' => $commision_paid_at,
                    'commission_verified_by' => $commission_verified_by,
                    'created_by' => Auth::user()->id,
                    'persons' => $request->persons
                ]
                );

            
            $current_month = new DateTime($request->strat_from);

            for ($i=0; $i <  (int) $request->contract_period; $i++) { 

                $c_month = $current_month;
                $now_month = $c_month->format('Y-m-d');
                // echo "C Month: ".$c_month->format('Y-m-d')."<br><br>";

                // echo "Current Month: ".$current_month->format('Y-m-d')."<br>";

                $next_month = $current_month->modify('+1 month');
                $noxt_month = $next_month->format('Y-m-d');
                // echo "Next Month : ".$next_month->format('Y-m-d')."<br><br>";

                
                
                Invoices::create(
                    [
                        'tenant_contract_id' => $tenant_contract->id,
                        'property_id' => $request->property_id,
                        'amount' => $request->price,
                        'from_date' => $now_month,
                        'till_date' =>$noxt_month,
                        'invoice_number' => rand(10000000,12345678),
                        'invoice_type' => 'tenant invoice'
                    ]
                    );

                $current_month = $next_month;
               
            }

        $property_info = Properties::find($request->property_id);

        // Updating User Account 

        $tenant_account = User::find($request->tenant_id);

        if ($tenant_account->status == 0) {
            
            $password = Str::random(8);
            $tenant_account->status = "1";
            $tenant_account->password = Hash::make($password);
            $tenant_account->save();

        //Sent New Account Password 

            Mail::to($tenant_account->email)->send(new UserRegister($tenant_account,$password));
        }

        //Updating Booking Enquiries 

        //Sending Contract Email 

         Mail::to($tenant_account->email)->send(new TenantContract($tenant_account->first_name." ".$tenant_account->last_name,public_path().'/upload/booking/'.$file_name));

        BookingEnquiries::where('id',$request->e_id)->update(['status'  => 'selected']);

        session()->flash('success', 'New Tenant Contract Started Successfully');

        return redirect()->route('admin.property.details',$property_info->slug);
    }
    //Properties Types 
    public function type_index(){
     
        return view('admin.properties.types.index');
    }
    public function create_type(){
         return view('admin.properties.types.create');
    }
    public function store_type(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'status' => 'required',
            ]
            );

        $slug = Str::slug($request->name);

        $if_exist = PropertyTypes::where('name',$request->name)->first();
        if (!empty($if_exist)) {
            return Redirect::back()->withErrors('Sorry Property Type with the given name already exists')->withInput();
        }

        PropertyTypes::create(
            [
                'name' => $request->name,
                'slug' => $slug,
                'status' => $request->status
            ]
            );
        session()->flash('success','Property Type Added Successfully');
        return redirect()->route('admin.property.types.list');
    }
    public function edit_type($id){

        $type = PropertyTypes::find($id);
        return view('admin.properties.types.create',compact('type'));
    }
    public function update_type(Request $request,string $id){

         $request->validate(
            [
                'name' => 'required',
                'status' => 'required',
            ]
            );

            $slug = Str::slug($request->name);

            $if_exist = PropertyTypes::where('name',$request->name)->first();
            if (!empty($if_exist)) {
                return Redirect::back()->withErrors('Sorry Property Type with the given name already exists')->withInput();
            }

             PropertyTypes::where('id',$id)->update(
            [
                'name' => $request->name,
                'slug' => $slug,
                'status' => $request->status
            ]
            );
        session()->flash('success','Property Type Added Successfully');
        return redirect()->route('admin.property.types.list');
    }
    public function delete_type($id){

        $info = PropertyTypes::find($id);
        if (empty($info)) {
            
            session()->flash('errors' ,'Sorry this record is not loger exist');
            return redirect()->route('admin.property.types.list');
        }

        $info->delete();

         session()->flash('success' ,'record Deleted successfully');
         return redirect()->route('admin.property.types.list');
    }

    public function province_json($id){
        return response()->json(Provinces::where('country_id',$id)->get());
    }
    //Technision Curd 
    public function technision_list(){
        return view('admin.technisions.index');
    }
    public function technision_create(){
         return view('admin.technisions.create');
    }
    public function technision_store(Request $request){
        $request->validate(
            [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|unique:users',
                'gender' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'role' => 'required',
                'province' => 'required',
                'postcode' => 'required',
                'status' => 'required',
                'password' => 'nullable|required_with:password_confirmation|string|confirmed'
            ]
            );

       User::create(
        [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'province_id' => $request->province,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'status'  => $request->status
        ]
        );

      session()->flash('success', 'User Data Stored Successfully');

      return redirect()->route('admin.user.list');
    }
    public function technision_edit($id){

       $technision = User::find($id);
       $province = null;

       if (!empty($technision)) {
        
         $province = Provinces::find($technision->province_id);
       }

       return view('admin.technisions.create',compact('technision','province'));
    }
    public function technision_update(Request $request,string $id){
      
      $request->validate(
            [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required',
                'gender' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'role' => 'required',
                'province' => 'required',
                'postcode' => 'required',
                'status' => 'required'
            ]
            );

       User::where('id',$id)->update(
        [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'province_id' => $request->province,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'email' => $request->email,
            'role' => $request->role,
            'status'  => $request->status
        ]
        );

      session()->flash('success', 'User Data Updated Successfully');

      return redirect()->route('admin.user.list');
    }
    public function technision_delete($id){

        $user_info = User::find($id);

        if (empty($user_info)) {

            session()->flash('errors','the User record is no longer exist');
            return redirect()->route('admin.user.list');
        }

       $user_info->delete();

       session()->flash('success','User Data Deleted Successfully');
       return redirect()->route('admin.user.list');
    }

    //Province CURD

    public function province_list(){
        return view('admin.province.index');
    }
    public function province_create(){
         return view('admin.province.create');
    }
    public function province_store(Request $request){
       $request->validate(
        [
            'country_id' => 'required',
            'name' => 'required',
            'short_name' => 'required',
            'status' => 'required',
        ]
        );
      
      Provinces::create(
        [
            'country_id' => $request->country_id,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'status' => $request->status
        ]
        );

        session()->flash('success','Province Record Added Successfully');
        return redirect()->route('admin.province.list');
    }
    public function province_edit($id){
        $province = Provinces::find($id);

        return view('admin.province.create',compact('province'));
    }
    public function province_update(Request $request,string $id){
        $request->validate(
        [
            'country_id' => 'required',
            'name' => 'required',
            'short_name' => 'required',
            'status' => 'required',
        ]
        );
      
      Provinces::where('id',$id)->update(
        [
            'country_id' => $request->country_id,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'status' => $request->status
        ]
        );

        session()->flash('success','Province Record Updated Successfully');
        return redirect()->route('admin.province.list');
    }
    public function province_delete($id){
        $province = Provinces::find($id);

        if (empty($province)) {
            
            session()->flash('error','Province Record no longer exists');
            return redirect()->route('admin.province.list');
        }

        $province->delete();

        session()->flash('success','Province Record deleted Successfully');
        return redirect()->route('admin.province.list');
    }

    //Property Featuer CURD 

    public function property_feature_list(){
        return view('admin.properties.features.index');
    }
    public function property_feature_create(){
        return view('admin.properties.features.create');
    }
    public function property_feature_store(Request $request){
        $request->validate(
            [
                'title' => 'required',
                'status' => 'required',
            ]
        );

        PropertyFeatures::create(
            [
                'title' => $request->title,
                'status' => $request->status
            ]
            );

        session()->flash('success','Property Feature Added Successfully');
        return redirect()->route('admin.property.feature.list');
    }
    public function property_feature_edit($id){
        $feature = PropertyFeatures::find($id);
         return view('admin.properties.features.create',compact('feature'));
    }
    public function property_feature_update(Request $request,string $id){
        $request->validate(
            [
                'title' => 'required',
                'status' => 'required',
            ]
        );

        PropertyFeatures::where('id',$id)->update(
            [
                'title' => $request->title,
                'status' => $request->status
            ]
            );

        session()->flash('success','Property Feature Updated Successfully');
        return redirect()->route('admin.property.feature.list');
    }
    public function property_feature_delete($id){
        $feature = PropertyFeatures::find($id);

        if (empty($feature)) {
            
            session()->flash('error','Property Feature no longer Exist');
            return redirect()->route('admin.property.feature.list');
        }

        $feature->delete();
        session()->flash('success','Property Feature deleted Successfully');
        return redirect()->route('admin.property.feature.list');
    }

    //Booking Enquiries 
    public function booking_enquiries(){

        $enquiries = BookingEnquiries::orderBy('id','desc')->with(['property','tenant'])->get();

        return view('admin.bookings.enquiries.index',compact('enquiries'));
    }
    public function update_booking_enquiry(Request $request){
        
        $enquiry = BookingEnquiries::find($request->e_id);

        //uploading Landlord File 

        $file  = $request->landlord_file_name;
        $new_name = '';

        if (!empty($file)) {
            $new_name = rand().'.'.$file->getClientOriginalExtension();
            if(File::exists(public_path('upload/booking/').$enquiry->landlord_file_name)) {
                File::delete(public_path('upload/booking/').$enquiry->landlord_file_name);
            }
            $file->move(public_path('upload/booking'),$new_name);
            $enquiry->landlord_file_name = $new_name;

        }

        //Uploading Tenant File 

        $file  = $request->tenant_file_name;
        $new_name = '';

        if (!empty($file)) {
            $new_name = rand().'.'.$file->getClientOriginalExtension();
            if(File::exists(public_path('upload/booking/').$enquiry->tenant_file_name)) {
                File::delete(public_path('upload/booking/').$enquiry->tenant_file_name);
            }
            $file->move(public_path('upload/booking'),$new_name);
            $enquiry->tenant_file_name = $new_name;

        }

        if (!empty($request->status)) {
            
            $enquiry->status = $request->status;
        }

        $enquiry->save();

        session()->flash('success', 'Enquiry successfully updated');

        return redirect()->route('admin.booking.enquiries');

    }

    //Start Contract 
    public function start_contract(Request $request){

        $request->validate(
            [
                'e_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
                'commision' => 'required',
            ]
            );
        
            $months = self::get_months($request->start_date,$request->end_date);

            $start_day = date_format(date_create($request->start_date),'d');
            $end_day = date_format(date_create($request->end_date),'d');
            $year = date_format(date_create($request->start_date),'Y');
            $booking_enquiry = BookingEnquiries::where('id',$request->e_id)->with('property')->first();

            $booking_enquiry->status = $request->status;
            $booking_enquiry->save();
            $count = 0;
            $from_date = date_format(date_create($request->start_date),'Y-m-d');

            foreach ($months as $key=> $month) {
                
                $invoice_year = $year;
                $month =  (int) $month;
                
                

                if ($key < count($months) && $month == 12) {
                   
                    $year += 1;
                }

                if ($key == count($months) - 1) {
                   $till_date = $invoice_year.'-'.$month.'-'.$end_day; 
                }else{

                    $till_date = $invoice_year.'-'.$month.'-'.$start_day;
                }

                

                if ($key > 0) {
                   
                     Invoices::create(
                    [
                        'enquiry_id' => $request->e_id,
                        'property_id' => $booking_enquiry->property_id,
                        'amount' => $booking_enquiry->property->price,
                        'from_date' => $from_date,
                        'till_date' => $till_date,
                    ]
                    );
                }

                

                

                if ( $key > 0) {
                    $from_date = $till_date;
                }

            }

        session()->flash('success', 'New Tenant Contract has been started successfully');

        return redirect()->route('admin.booking.enquiry.invoices',$request->e_id);

    }

    //Get Months Between Two Dates 

    function get_months($date1, $date2) {
        $time1  = strtotime($date1);
        $time2  = strtotime($date2);
        $my     = date('mY', $time2);
        $months = array(date('m', $time1));
        while($time1 < $time2) {
            $time1 = strtotime(date('Y-m-d', $time1).' +1 month');
            if(date('mY', $time1) != $my && ($time1 < $time2))
                $months[] = date('m', $time1);
        }
        $months[] = date('m', $time2);
        return $months;
    }

    //Booking Enquiry Invoices 

    public function enquiry_invoices($e_id){

        $enquiry = BookingEnquiries::where('id',$e_id)->with('tenant')->first();

        $invoices = Invoices::where('enquiry_id', $e_id)->with('property')->get();

        return view('admin.bookings.invoices.index',compact('enquiry','invoices'));
    }

    public function pay_invoice($id){

        $invoice = Invoices::find($id);

        Invoices::where('id',$id)->update(
            [
                'status' => 'paid',
                'paid_at' => date('Y-m-d H:i:s')
            ]
            );
      session()->flash('success','Invoice has been paid Successfully');

      return redirect()->route('admin.booking.enquiry.invoices',$invoice->enquiry_id);
    }
    //Issue Tickets 

    public function issue_tickets($b_id){

        $issue_tickets = IssueTickets::issue_tickets($b_id);

        return view('admin.issues.index',compact('issue_tickets'));
    }
    public function issue_ticket($id){

        $issue_ticket = IssueTickets::find($id);
        $tichenisions = User::where('role','technision')->get();

        return view('admin.issues.single',compact('issue_ticket','tichenisions'));
    }

    public function assign_technision(Request $request){

        $request->validate(
            [
                'ticket_id' => 'required',
                'technision' => 'required',
                'priority' => 'required',
            ]
            );

        IssueTickets::where('id',$request->ticket_id)->update(
            [
                'assigned_to' => $request->technision,
                'assigned_by' => Auth::user()->id,
                'priority' => $request->priority,
                'status' => 'in progress'
            ]
            );
        
        session()->flash('success','Technision Assigned Successfully');

        return redirect()->route('admin.issue.ticket',$request->ticket_id);
    }

    //Rented Properties 

    public function rented_properties(){

        // $tenant_contracts = TenantContracts::orderBy('id','desc')->with(['tenant','property'])->get();

        $tenant_contracts = DB::select("SELECT tc.*,p.title_en,p.title_nl,p.slug,CONCAT(t.first_name,' ',t.last_name) as tenant,p.street_address as location,CONCAT(l.first_name,' ',l.last_name) as landlord  FROM `tenant_contracts` tc JOIN properties p ON tc.property_id = p.id JOIN users t ON tc.user_id = t.id JOIN users l ON p.user_id = l.id WHERE  (tc.expired_at >= '".date('Y-m-d')."' AND tc.terminated_on IS NULL)");

        return view('admin.properties.rented',compact('tenant_contracts'));
    }

    //Landlord Invoices Json
    public function landlord_invoices($b_id){

        $invoices = Invoices::where(['tenant_contract_id' => $b_id,'invoice_type' => 'landlord invoice'])->get();

        $invoice_list = array();

        foreach ($invoices as $key => $inc) {
            
            $invoice_list [] = [
                'id' => $inc->id,
                'invoice_number' => $inc->invoice_number,
                'invoice_type' => ucwords($inc->invoice_type),
                'month' => date_format(date_create($inc->from_date),'M').'-'.date_format(date_create($inc->from_date),'Y').'/'.date_format(date_create($inc->till_date),'M')."-".date_format(date_create($inc->till_date),'Y'),
                'status' => $inc->status,
                'amount' => number_format($inc->amount,2),
            ];
        }

        return response()->json($invoice_list);
    }

    //Pay Landlord Invoice

    public function pay_landlord_invoice($id){

        $invoice = Invoices::Find($id);

        if (empty($invoice)) {
            
            return response()->json(['success' => false,'message' => 'Invoice not found']);
        }

        $invoice->status = 'paid';
        $invoice->paid_at = date('Y-m-d H:i:s');

        $invoice->save();


        $landlord_contract = LandlordContracts::find($invoice->tenant_contract_id);

        $property = Properties::find($landlord_contract->property_id);

        $owner = User::find($property->user_id);



        // Landlord Invoice Paid Email 

        Mail::to($owner->email)->send(new LandlordInvoicePaid($owner->first_name." ".$owner->last_name,$property->title_en,date_format(date_create($invoice->from_date),'F'),$invoice->amount));


        return response()->json(['success' => true,'message' => 'Invoice Paid Successfully']);
    }

    //Resolve Issue Option

    public function resolve_issue_add($id){

        $issue_ticket = IssueTickets::find($id);

        return view('admin.issues.resolve',compact('issue_ticket'));
    }

    //Resolve Issue Post

    public function resolve_issue_post(Request $request){

        $request->validate(
            [
                'status' => 'required',
                'priority' => 'required',
                'issue_identification' => 'nullable',
                'issue_resolved_description' => 'nullable',
                'cost' => 'nullable|numeric',
                'remarks' => 'nullable'
            ]
            );

            IssueTickets::where('id',$request->issue_id)->update(
                [
                    'status' => $request->status,
                    'priority' => $request->priority,
                    'issue_identification' => $request->issue_identification,
                    'issue_resolved_description' => $request->issue_resolved_description,
                    'updated_by' => Auth::user()->id
                ]
                );
        $if_exist = IssueTicketInvoices::where('issue_ticket_id',$request->issue_id)->first();

        if (!empty($if_exist)) {
            
            $if_exist->cost = $request->cost;
            $if_exist->remark = $request->remarks;
            if (!empty($request->cost_paid)) {
                
                $if_exist->paid = 1;
                $if_exist->paid_by = Auth::user()->id;
            }
            $if_exist->save();
        }else{

            IssueTicketInvoices::create(
                [
                    'issue_ticket_id' => $request->issue_id,
                    'cost' => $request->cost,
                    'remark' => $request->remarks,
                    'paid' => !empty($request->cost_paid) ? 1 : 0,
                    'paid_by' => !empty($request->cost_paid) ? Auth::user()->id : ''
                ]
                );
        }

        session()->flash('success','Issue Ticket Invoice has been created Successfully');

        return redirect()->route('admin.issue.ticket',$request->issue_id);
    }

    //Issue Ticket Payment 

    public function issue_ticket_payment(Request $request){
        $request->validate(
            [
                'ticket_id' => 'required',
            ]
            );

        IssueTicketInvoices::where('id',$request->ticket_id)->update(
            [
                'remark' => $request->remarks,
                'paid_by' => Auth::user()->id,
                'paid' => 1
            ]
            );
        $issue_ticket_invoice = IssueTicketInvoices::find($request->ticket_id);

        session()->flash('success','Issue Ticket Invoice has been created Successfully');

        return redirect()->route('admin.issue.ticket',$issue_ticket_invoice->issue_ticket_id);
    }
    //Issue Ticket Receipt 
    public function issue_ticket_receipt($id){

        $ticket = IssueTicketInvoices::find($id);

        $issue_ticket = IssueTickets::find($ticket->issue_ticket_id);

        $pdf = Pdf::loadView('admin.issues.issue-invoice',compact('ticket','issue_ticket'))->setOption('isHtml5arserEnabled',true)->setOption('isPhpEnabled',true)->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path()
        ]);

        $ticket_no = rand(10000000,12345678).date('Y-m-d H:i:s');

        return $pdf->download('Issue-Ticket-Invoice-'.$ticket_no.'.pdf');
    }

    //Terminate Tenant Contract 
    public function terminate_tenant_contract(Request $request){

        $request->validate(
            [
                'termination_reason' => 'required',
                'e_id' => 'required',
            ]
            );

        TenantContracts::where('id',$request->e_id)->update(
            [
                'terminated_by' => Auth::user()->id,
                'terminated_on' => date('Y-m-d H:i:s'),
                'termination_reason' => $request->termination_reason
            ]
            );

        $tenant_contract = TenantContracts::find($request->e_id);

        $property = Properties::find($tenant_contract->property_id);

        session()->flash('success','Tenant Contract Successfuly Terminated');

        return redirect()->route('admin.property.details',$property->slug);
    }

    public function landlord_tenant_contract(Request $request){

        $request->validate(
            [
                'termination_reason' => 'required',
                'e_id' => 'required',
            ]
            );

        LandlordContracts::where('id',$request->e_id)->update(
            [
                'terminated_by' => Auth::user()->id,
                'terminated_on' => date('Y-m-d H:i:s'),
                'termination_reason' => $request->termination_reason
            ]
            );

        $tenant_contract = LandlordContracts::find($request->e_id);

        

        session()->flash('success','Landlord Contract Successfuly Terminated');

        return redirect()->back();

    }

    public function pay_commision_amount(Request $request){

       $request->validate(
        [
            'e_id' => 'required',
            'amount' => 'required',
        ]
        );

        $tenant_contract = TenantContracts::find($request->e_id);

        if (!empty($tenant_contract)) {
            
            $tenant_contract->commission_paid_at = date('Y-m-d H:i:s');
            $tenant_contract->commission_verified_by = Auth::user()->id;
            $tenant_contract->save();
            $property = Properties::find($tenant_contract->property_id);
            session()->flash('success','Commision Amount Paid Successfully');
            if (!empty($property)) {
               
                return redirect()->route('admin.property.details',$property->slug);

            }
        }
    }

    //Admin list

    public function admin_list(){

        $admin_list = User::where('role','admin')->get();

        return view('admin.admin_list',compact('admin_list'));
    }
    
    //Edit Property 

    public function edit_property($id){

        $property = Properties::find($id);

        return view('admin.properties.edit_property',compact('property'));
    }
    public function update_property(Request $request,string $id){

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
         }else{
            $property_images_arr = explode(",",$property_info->property_image);
         }
        // 

        //uploading Feature Images

        if (!empty($feature_images) && count($feature_images) > 0) {
            
           foreach ($feature_images as $image) {
              $new_name = rand().'.'.$image->getClientOriginalExtension();
                
                $image->move(public_path('upload/property/feature'),$new_name);
                array_push($feature_images_arr,$new_name);
           }
        }else{
            $feature_images_arr = explode(",",$property_info->feature_image);
         }

        
         if ($request->featured == 1) {
             
             Properties::where('featured' ,1)->update(['featured' => 0]);
         }

        Properties::where('id',$id)->update( 
            [
                'title_en' => $request->title_en,
                'description_en' => $request->description_en,
                'slug' => $slug,
                'price' => $request->price,
                'contract_period' => $request->contract_period,
                'property_type_id' => $request->property_type_id,
                'province_id' => $request->province_id,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'street_address' => $request->street_address,
                'features' => !empty($request->features) && count($request->features) > 0 ? implode(",",$request->features) : '',
                'available_from' => !empty($request->available_from) ? date_format(date_create($request->available_from),'Y-m-d') : '',
                'area' => $request->area,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'kitchens' => $request->kitchens,
                'garages' => $request->garages,
                'parkings' => $request->parkings,
                'toilets' => $request->toilets,
                'featured' => $request->featured,
                'title_nl' => $request->title_nl,
                'description_nl' => $request->description_nl,
                'feature_image' => !empty($feature_images_arr) && count($feature_images_arr) > 0 ? implode(",",$feature_images_arr) : $property_info->feature_image,
                'property_image' => !empty($property_images_arr) && count($property_images_arr) > 0 ? implode(",",$property_images_arr) : $property_info->property_image,
                'youtube_url' => $request->youtube_url
            ]
            );

            $property = Properties::find($id);

        session()->flash('success','Property Updated Successfully');

        return redirect()->route('admin.property.details',$property->slug);
    }

    public function all_landlord_contract($id){

      $landlord_contracts = LandlordContracts::contracts_by_property($id);
      $property = Properties::find($id);

      return view('admin.landlord_contracts',compact('landlord_contracts','property'));
    }
    public function all_tenant_contract($id){

        $tenant_contracts = TenantContracts ::where('property_id',$id)->with(['tenant','property'])->orderBy('id','desc')->get();
        $property = Properties::find($id);

        return view('admin.tenant_contract',compact('tenant_contracts','property'));
    }

    //Inspections 

    public function inspections($id){

        // $data = $request->all();
        // // return $data;
        // $property = Properties::find($data['property']);

        // if (!empty($_GET['type']) && $_GET['type'] != 'all_inspection') {
            
        //     if ($_GET['type'] == 'pre_inspection') {
        //         $inspections = Inspections::where(['inspectionable_id' => $_GET['property'],'inspection_type' => 'Pre Inspection'])->get();
        //     }else if($_GET['type'] == 'regular_inspection'){
        //         $inspections = Inspections::where(['inspectionable_id' => $_GET['property'],'inspection_type' => 'Regular Inspection'])->get();
        //     }else if($_GET['type'] == 'end_inspection'){
        //         $inspections = Inspections::where(['inspectionable_id' => $_GET['property'],'inspection_type' => 'Post Inspection'])->get();
        //     }

        // }else{
            $inspections = Inspections::where(['inspectionable_id' => $id])->get();
        // }
        
        $tenant_contract = TenantContracts::where('id',$id)->with(['tenant','property'])->first();

        return view('admin.inspection.index',compact('inspections','tenant_contract'));
    }
    public function store_inspection(Request $request){

        $request->validate(
            [
                'enquiry_id' => 'required',
                'inspection_type' => 'required',
                'inspection_date' => 'required',
                'inspected_by' => 'required',
                'inspection_notes' => 'nullable'
            ]
            );

         $inspection_code = '';

         do{
                $v_code = rand(10000000,12345678);
                $inspection_code = $v_code;

                $exist = Inspections::where('inspection_code',$inspection_code)->get();

            }while(count($exist) !=0);

        Inspections::create(
            [
                'inspectionable_id' => $request->enquiry_id,
                'inspectionable_type' => $request->inspectionable_type,
                'inspection_code' => $inspection_code,
                'inspection_type' => $request->inspection_type,
                'inspection_date' => date_format(date_create($request->inspection_date),'Y-m-d H:i:s'),
                'inspection_notes' => $request->inspection_notes,
                'inspected_by' => $request->inspected_by
            ]
            );

        session()->flash('success','Inspection Created Successfully');


        return redirect()->route('admin.inspections.list',$request->enquiry_id);
    }
    public function inspection_update(Request $request,string $id){
        $request->validate(
            [
                'inspection_type' => 'required',
                'inspection_date' => 'required',
                'inspected_by' => 'required',
                'inspection_notes' => 'nullable'
            ]
            );

        Inspections::where('id',$id)->update(
            [
                'inspectionable_id' => $request->enquiry_id,
                'inspectionable_type' => $request->inspectionable_type,
                'inspection_type' => $request->inspection_type,
                'inspection_date' => date_format(date_create($request->inspection_date),'Y-m-d H:i:s'),
                'inspection_notes' => $request->inspection_notes,
                'inspected_by' => $request->inspected_by
            ]
            );

         session()->flash('success','Inspection Updated Successfully');
         return redirect()->route('admin.inspections.list',$request->enquiry_id);
        
        // return redirect($inspection_url);
    }
    public function inspection_delete($id){

         
        $inspection = Inspections::find($id);

        $enquiry_id = $inspection->inspectionable_id;

        $inspection->delete();

        session()->flash('success','Inspection Deleted Successfully');

        session()->flash('success','Inspection Updated Successfully');
         return redirect()->route('admin.inspections.list',$enquiry_id);
    }

    //View Inspection Contents 
    public function inspection_content($id){

        $inspection = Inspections::find($id);

        if (empty($inspection)) {
            
            return redirect()->back()->withErrors('Sorry no Inspection Record Found');
        }

        $tenant_contract = TenantContracts::where('id',$inspection->inspectionable_id)->with('tenant','property')->first();
        
        return view('admin.inspection.detail',compact('inspection','tenant_contract'));
    }

    // CMS Pages CURD 
    public function cms_pages_index(){

        return view('admin.cms.index');
    }
    public function cms_pages_create(){
        return view('admin.cms.create');
    }
    public function cms_pages_store(Request $request){

        $request->validate(
            [
                'title' => 'required',
                'content_en' => 'required',
                'content_nl' => 'required',
                'show_on' => 'required',
                'status' => 'required',
            ]
            );
        $slug = Str::slug($request->title);

        $if_exist = cms::where('slug',$slug)->get();
        if (count($if_exist) > 0) {
            
             $slug = $slug.'-'.Str::random(4);
        }

        cms::create(
            [
                'title' => $request->title,
                'slug' => $slug,
                'content_en' => $request->content_en,
                'content_nl' => $request->content_nl,
                'show_on' => $request->show_on,
                'status' => $request->status
            ]
            );

        session()->flash('success','CMS Page Created Successfully');

        return redirect()->route('admin.cms.pages.list');
    }
    public function cms_pages_edit($id){

        return view('admin.cms.create')->with('cms',cms::find($id));
    }
    public function cms_pages_update(Request $request,string $id){
         $request->validate(
            [
                'title' => 'required',
                'content_en' => 'required',
                'content_nl' => 'required',
                'show_on' => 'required',
                'status' => 'required',
            ]
            );

            $slug = Str::slug($request->title);

            $if_exist = cms::where('slug',$slug)->get();
            if (count($if_exist) > 0) {
                
                $slug = $slug.'-'.Str::random(4);
            }
        cms::where('id',$id)->update(
            [
                'title' => $request->title,
                'slug' => $slug,
                'content_en' => $request->content_en,
                'content_nl' => $request->content_nl,
                'show_on' => $request->show_on,
                'status' => $request->status
            ]
            );

        session()->flash('success','CMS Page Updated Successfully');

        return redirect()->route('admin.cms.pages.list');
    }
    public function cms_pages_delete($id){

        cms::where('id',$id)->delete();

        session()->flash('success','CMS Page Deleted Successfully');

        return redirect()->route('admin.cms.pages.list');
    }

    public function remove_property_image(Request $request){

        $property = Properties::find($request->id);

        if (empty($property)) {
            
            return response()->json(['success' => false,'sorry no property found']);
        }

        $newString = str_replace($request->img.",", '', $property->property_image);

         if(File::exists(public_path('upload/property/').$request->img)) {
                File::delete(public_path('upload/property/').$request->img);
            }

      $property->property_image = $newString;
      $property->save();

      return response()->json(['success' => true,'Image Removed']);
    }
}
