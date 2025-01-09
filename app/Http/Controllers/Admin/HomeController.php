<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
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

        return redirect()->route('admin.properties');
    }

    //Property Details 
    public function property_details($slug){

        $property = Properties::where('slug',$slug)->with(['landlord','type'])->first();
        $landlord_contract = LandlordContracts::orderBy('id','desc')->where(['property_id' => $property->id,'terminated_on' => null,'expired_at' => ' > '. date('Y-m-d')])->first();
        $tenant_contract = TenantContracts::orderBy('id','desc')->where(['expired_at' => ' > '. date('Y-m-d')])->first();

        $t_contracts = DB::select("SELECT * FROM `tenant_contracts` WHERE expired_at >= '".date('Y-m-d')."'");

        if (count($t_contracts) > 0) {
           $tenant_contract = $t_contracts[0]; 

        }

        $l_contracts = DB::select("SELECT * FROM `landlord_contracts` WHERE expired_at >= '".date('Y-m-d')."'");

        if (count($l_contracts) > 0) {
            
            $landlord_contract = $l_contracts[0];
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
                'contract_period' => $contract_period,
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

        session()->flash('success', 'Landlord Contract Created Successfully');

        return redirect()->route('admin.property.details',$property_info->slug);
    }


    public function single_quries($id){

        $enquiry = BookingEnquiries::where('id',$id)->with(['tenant','property'])->first();

        $landlord_contract = LandlordContracts::orderBy('id','desc')->where(['property_id' => $enquiry->property->id,'terminated_on' => null,'expired_at' => ' < '. date('Y-m-d')])->first();

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
                    'commission_verified_by' => !empty($commision_paid_at) ? Auth::user()->id : null,
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
        }

        //Updating Booking Enquiries 

        BookingEnquiries::where('id',$request->e_id)->update(['status'  => 'selected']);

        session()->flash('success', 'Tenant Contract Created Successfully');

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
                'country' => 'required',
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
            'country_id' => $request->country,
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

      session()->flash('success', 'Technision Data Stored Successfully');

      return redirect()->route('admin.technision.list');
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
                'country' => 'required',
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
            'country_id' => $request->country,
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

      session()->flash('success', 'Technision Data Updated Successfully');

      return redirect()->route('admin.technision.list');
    }
    public function technision_delete($id){

        $user_info = User::find($id);

        if (empty($user_info)) {

            session()->flash('errors','the technision record is no longer exist');
            return redirect()->route('admin.technision.list');
        }

       $user_info->delete();

       session()->flash('success','Technision Data Deleted Successfully');
       return redirect()->route('admin.technision.list');
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

    //Active Account 
    public function active_tenant_account($e_id){

        $enquiry = BookingEnquiries::find($e_id);

        $tenant = User::find($enquiry->tenant_id);

        $password = Str::random(8);

        $tenant->status = "1";
        $tenant->password = Hash::make($password);
        $tenant->save();

        session()->flash('success', 'Tenant Account has been successfully activated'.$password);

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

        session()->flash('success', 'Invoices have been Generated Successfully');

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


    //Generate Contract Files  For Landlord and Tenant 

    public function generate_contract_files($e_id,$for){

        $booking_enquiry = BookingEnquiries::where('id',$e_id)->with(['property','tenant'])->first();
        $property = null;

        if (!empty($booking_enquiry)) {
          
            $property = $booking_enquiry->property;

        }
        $company_name = env('Business_Title');
        $tenant_name = !empty($booking_enquiry->tenant) ? $booking_enquiry->tenant->first_name." ".$booking_enquiry->tenant->last_name : '';
        $todays_date = date('F d, Y ');
        $contract_officer = 'Anis';

        $property_owner = !empty(User::where('id',$property->user_id)->first()) ? User::where('id',$property->user_id)->first()->first_name." ".User::where('id',$property->user_id)->first()->last_name : '';

        if ($for == 'tenant') {
            // return view('admin.bookings.enquiries.contract_files.tenant-contracts',compact('company_name','tenant_name','property','todays_date','contract_officer'));

            $pdf = Pdf::loadView('admin.bookings.enquiries.contract_files.tenant-contracts',compact('company_name','tenant_name','property','todays_date','contract_officer'))->setOption('isHtml5arserEnabled',true)->setOption('isPhpEnabled',true)->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path()
        ]);

            return $pdf->download('Tenant-Contract.pdf');

        }else{
            return view('admin.bookings.enquiries.contract_files.landlord-contracts',compact('todays_date','property_owner','company_name','property'));
        }
    }

    
    
}
