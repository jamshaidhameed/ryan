<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Provinces; 
use App\Models\User;
use App\Models\Properties;
use App\Models\BookingEnquiries;
use App\Models\Invoices;
use App\Models\TenantContracts;
use App\Models\IssueTickets;
use App\Mail\IssueTicket;
use Auth;
use File;

class HomeController extends Controller
{
    public function index(){
        
         return view('tenant.index');

    }
     public function provinces_json($country_id){
        return response()->json(Provinces::where('country_id',$country_id)->get());
    }
    
    public function update_user_profile(Request $request){
        
        $request->validate(
            [
                'first_name' =>'required|string|max:255',
                'last_name' =>'required|string|max:255',
                'gender' => 'required',
                'email' => 'required|string|max:255',
                'province_id' => 'required',
                'phone' => 'required',
                'city' => 'required|string|max:255',
                'postcode' => 'required|string|max:255',
                'street_address' => 'nullable|string|max:255'
            ]
            );
        
        $image = $request->file;

        $tenant = User::find(Auth::user()->id);
        $new_name = '';

        if (!empty($image)) {

            $new_name = rand().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('upload/tenant'),$new_name);

            if(File::exists(public_path('upload/tenant/').$tenant->image)) {
                File::delete(public_path('upload/tenant/').$tenant->image);
            }


        }else{

            $new_name = $tenant->image;
        }

        User::where('id',$tenant->id)->update(
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

        return redirect()->route('tenant.dashboard');
    }

    //Booking Enquiries 
    public function booking_enquiries(){
        
        $my_quries = TenantContracts::orderBy('id','desc')->where('user_id',Auth::user()->id)->with('property')->paginate(10);

        return view('tenant.booking.enquiries.index',compact('my_quries'));
        
    }

    //Get Single Tenant Contract

    public function single_tenant_contract($id){

        $tenant_contract = TenantContracts::find($id);
        $contract = null;

        if ($tenant_contract) {
            
            $contract  = $tenant_contract->link;
            $tenant_contract->link = asset('upload/booking/'.$contract);
        }

        return response()->json($tenant_contract);
    }

    //Upload File for the Enquiry
    public function upload_file_for_enquiry(Request $request){
        $file = $request->tenant_uploaded_file;

        $contract = TenantContracts::find($request->e_id);

        $file_name = rand().'.'.$file->getClientOriginalExtension();

        if(File::exists(public_path('upload/booking/').$contract->link)) {
                File::delete(public_path('upload/booking/').$contract->link);
            }

         $file->move(public_path('upload/booking'),$file_name);

         $contract->signed_at = date('Y-m-d H:i:s');

         $contract->save();

        // $enquiry = BookingEnquiries::find($request->e_id);

        // if (!empty($file)) {
            
        //     $new_name = rand().'.'.$file->getClientOriginalExtension();
        //     if(File::exists(public_path('upload/booking/').$enquiry->tenant_uploaded_file)) {
        //         File::delete(public_path('upload/booking/').$enquiry->tenant_uploaded_file);
        //     }
        //     $file->move(public_path('upload/booking'),$new_name);

        //     $enquiry->tenant_uploaded_file = $new_name;
        // }

        // $enquiry->save();

        session()->flash('success','File Uploaded Successfully');

        return redirect()->route('tenant.booking.enquiries');
    }

    //My Invoices 
    public function my_invoices($e_id){
        
        $enquiry = BookingEnquiries::where('id',$e_id)->first();

        $invoices = Invoices::where(['tenant_contract_id' =>  $e_id,'invoice_type' => 'tenant invoice'])->with('property')->get();

        return view('tenant.booking.invoices.index',compact('enquiry','invoices'));
    }

    //Complaints 
    public function my_complaints($e_id){

        return view('tenant.booking.complaints.index',compact('e_id'));

    }
    public function create_complaint($e_id){

        return view('tenant.booking.complaints.create',compact('e_id'));
    }
    public function store_complaint(Request $request){

        $request->validate(
            [
                'prop_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'priority' => 'required',
            ]
            );

           $image = $request->file;
           $new_name = '';

        if (!empty($image)) {

            $new_name = rand().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('upload/issue'),$new_name);

            // if(File::exists(public_path('upload/tenant/').$tenant->image)) {
            //     File::delete(public_path('upload/tenant/').$tenant->image);
            // }
        }

        $issue_code = '';

        do{
            $v_code = rand(10000000,12345678);
            $issue_code = $v_code;

            $exist = IssueTickets::where('issue_code',$issue_code)->get();

        }while(count($exist) !=0);


        IssueTickets::create(
            [
                'tenant_contract_id' => $request->prop_id,
                'issue_raised_by' => Auth::user()->id,
                'issue_ticket_type' => $request->issue_type,
                'issue_code' => $issue_code,
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'description' => $request->description,
                'status' => 'pending',
                'priority' => $request->priority,
                'photo' => $new_name
            ]
            );

            //New Enquiry Email

            Mail::to(Auth::user()->email)->send(new IssueTicket(Auth::user()));

            

            session()->flash('success','Issue Ticket Added Successfully');

            return redirect()->route('tenant.booking.property.complaints',$request->prop_id);
    }
     
    //Change Password 
    public function change_password(){

        return view('tenant.change-password');
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
}
