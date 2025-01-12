<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\IssueTickets;
use App\Models\IssueTicketInvoices;
use Auth;
use File;
use Redirect;

class HomeController extends Controller
{
    public function index(){

        return view('technician.index');
    }

    public function update_profile(Request $request){

        $request->validate(
            [
                'first_name' =>'required|string|max:255',
                'last_name' =>'required|string|max:255',
                'gender' => 'required',
                'email' => 'required|string|max:255',
                'country_id' => 'required',
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

        return $pdf->download('Issue-Ticket-Invoice-'.$ticket->id.'.pdf');
    }
    public function change_password(Request $request){

    }
}
