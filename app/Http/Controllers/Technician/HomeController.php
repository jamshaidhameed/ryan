<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\IssueTickets;
use App\Models\IssueTicketInvoices;
use App\Models\Provinces;
use App\Models\Inspections;
use App\Models\TenantContracts;
use App\Models\InspectionContents;
use App\Models\InspectionFiles;
use Auth;
use File;
use Redirect;

class HomeController extends Controller
{
    public function index(){

        return view('technician.index');
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
                'province_id' => 'required',
                'phone' => 'required',
                'city' => 'required|string|max:255',
                'postcode' => 'required|string|max:255',
                'street_address' => 'nullable|string|max:255'
            ]
            );
        
        $image = $request->file;

        $technician = User::find(Auth::user()->id);
        $new_name = '';

        if (!empty($image)) {

            $new_name = rand().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('upload/technician'),$new_name);

            if(File::exists(public_path('upload/technician/').$technician->image)) {
                File::delete(public_path('upload/technician/').$technician->image);
            }


        }else{

            $new_name = $technician->image;
        }

        User::where('id',$technician->id)->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
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

        return redirect()->route('technision.dashboard');
    }

    public function issue_tickets(){

        $issue_tickets = IssueTickets::where('assigned_to',Auth::user()->id)->get();

       return view('technician.tickets.index',compact('issue_tickets'));
    }
    public function view_issue($id){

        $issue_ticket = IssueTickets::find($id);

        return view('technician.tickets.single',compact('issue_ticket'));
    }

    public function issue_resolve_option($id){

        $issue_ticket = IssueTickets::find($id);

        return view('technician.tickets.resolve',compact('issue_ticket'));
    }

    public function resolve_issue(Request $request){

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
                    'paid_by' => !empty($request->cost_paid) ? Auth::user()->id : NULL
                ]
                );
        }

        session()->flash('success','Issue Ticket Invoice has been created Successfully');

        return redirect()->route('technision.issue.show',$request->issue_id);

    }
    public function issue_invoice_pay(Request $request){

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

         return redirect()->route('technision.issue.show',$issue_ticket_invoice->issue_ticket_id);
        
    }

    public function download_issue_receipt($id){

        $ticket = IssueTicketInvoices::find($id);

        $issue_ticket = IssueTickets::find($ticket->issue_ticket_id);

        $pdf = Pdf::loadView('admin.issues.issue-invoice',compact('ticket','issue_ticket'))->setOption('isHtml5arserEnabled',true)->setOption('isPhpEnabled',true)->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path()
        ]);

        $ticket_no = rand(10000000,12345678).date('Y-m-d H:i:s');

        return $pdf->download('Issue-Ticket-Invoice-'.$ticket_no.'.pdf');
    }
    //Change Password 
    public function change_password(){

        return view('technician.password_change');
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

    // Inspection List

    public function inspection_list(){

        $inspections_list = Inspections::orderBy('id','desc')->where('inspected_by',Auth::user()->id)->get();

        return view('technician.inspector.index',compact('inspections_list'));
    }

    public function inspect($id){

        $inspection = Inspections::where('id',$id)->with('inspector')->first();
        $tenant_contract = TenantContracts::where('id',$inspection->inspectionable_id)->with(['tenant','property'])->first();

        return view('technician.inspector.inspection',compact('inspection','tenant_contract'));
    }

    //Electric Meter Form Submit

    public function inspection_form_submit(Request $request){
        
        $request->validate(
            [
                'title' => 'required',
                'insp_id' => 'required',
            ]
            );

        $title = $request->title;
        $names = $request->name;
        $values = $request->value;
        $comments = $request->comment;
        $images = $request->images;
        $inspection_dates = $request->inspection_date;
        $united_homes = $request->united_homes;

        $check_values = collect($values);
        $check_values->filter()->isEmpty();

        if (empty($names) || empty($values)) {
            
            return response()->json(['success' => false,'message' => 'Please fill the Form Completely']);
        }

        

        if (!empty($images) && count($images) > 0) {

            $if_images_exist = InspectionFiles::where(['inspection_id' => $request->insp_id,'title' => $request->title])->get();

            if (count($if_images_exist) > 0) {
                
                foreach ($if_images_exist as $ime) {
                
                if(File::exists(public_path('upload/inspection/').$ime->file_url)) {
                    File::delete(public_path('upload/inspection/').$ime->file_url);
                }
              }

              InspectionFiles::where(['inspection_id' => $request->insp_id,'title' => $request->title])->delete();
            }


            
           foreach ($images as $img) {
                
                $new_name = rand().'.'.$img->getClientOriginalExtension();

                $img->move(public_path('upload/inspection'),$new_name);

                InspectionFiles::create(
                    [
                        'inspection_id' => $request->insp_id,
                        'file_url' => $new_name,
                        'title' => $request->title
                    ]
                    );
           }
        }

         $if_exist = InspectionContents:: where(['inspection_id' => $request->insp_id,'title' => $request->title])->get();
         
            if (count($if_exist) > 0) {
                
                InspectionContents:: where(['inspection_id' => $request->insp_id,'title' => $request->title])->delete();
                
            }
        
        foreach ($names as $key => $name) {
            
            $value = !empty($values[$key]) ? $values[$key] : '';
            $comment = !empty($comments[$key]) ? $comments[$key] : '';
            $inspection_date = !empty($inspection_dates[$key]) ? date_format(date_create($inspection_dates[$key]),'Y-m-d') : '';
            $united_home = !empty($united_homes[$key]) ? $united_homes[$key] : '';

            InspectionContents::create(
                [
                    'inspection_id' => $request->insp_id,
                    'title' => $request->title,
                    'name' => $name,
                    'value' => $value,
                    'comment' => $comment,
                    'inspected_date' => $inspection_date,
                    'united_homes' => $united_home
                ]
                );
        }

        return response()->json(['success' => true,'message' => 'Inspection Stored Successfully']);
    }


}
