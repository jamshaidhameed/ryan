@extends('technician.layouts.master') 
@section('title')
 Issue Tickets
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1>My Profile</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('Home')}}</a></li>
                <li class="">{{ __('Issue Tickets') }}</li>
            </ul>
        </div>
    </div>
</div>
<div class="user-page content-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="user-profile-box mrb">
                    <!--header -->
                  @include('technician.layouts.sidebar')
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="my-address contact-2">
                    @php $user = Auth::user(); @endphp
                    <h3 class="heading-3">{{ __('Issue Tickets')}}</h3>
                    <!-- Table Start -->
                     <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Issue No</th>
                                <th class="text-center">Issue Type</th>
                                <th class="text-left">Property</th>
                                <th class="text-left">Address</th>
                                <th class="text-left">Issue Title</th>
                                <th class="text-left">Description</th>
                                <th class="text-center">Priority</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($issue_tickets as $ticket)
                             <tr>
                                <td>{{ $ticket->issue_code}}</td>
                                <td>{{ $ticket->issue_ticket_type}}</td>
                                <td>{{ $ticket->tenant_contract_id}}</td>
                                <td>{{ $ticket->title}}</td>
                                <td>{{ $ticket->title}}</td>
                                <td>{!! html_entity_decode($ticket->description) !!}</td>
                                <td>{{ ucwords($ticket->priority)}}</td>
                                <td>{{ ucwords($ticket->status)}}</td>
                                <td>
                                    <a href="{{ route('technision.issue.show',$ticket->id) }}" class="btn btn-primary btn-outline btn-sm"> <i class="fa fa-eye"></i> View</a>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                     </table>
                    <!-- Table End -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection