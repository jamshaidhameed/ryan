@extends('technician.layouts.master') 
@section('title')
 {{ __('titles.issue_ticket') }}
@endsection
@section('content')
<div class="sub-banner">
    <div class="container">
        <div class="breadcrumb-area">
            <h1> {{ __('titles.issue_ticket') }}</h1>
            <ul class="breadcrumbs">
                <li><a href="{{ route('landlord.dashboard') }}">{{ __('titles.home')}}</a></li>
                <li class=""> {{ __('titles.issue_ticket') }}</li>
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
                    <h3 class="heading-3"> {{ __('titles.issue_ticket') }}</h3>
                    <!-- Table Start -->
                     <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('titles.issue_code') }}</th>
                                <th class="text-center">{{ __('titles.issue_ticket_type') }}</th>
                                <th class="text-left">{{ __('titles.property') }}</th>
                                <th class="text-left">{{ __('titles.address') }}</th>
                                <th class="text-left">{{ __('titles.issue_title') }}</th>
                                <th class="text-left">{{ __('titles.description') }}</th>
                                <th class="text-center">{{ __('titles.priority') }}</th>
                                <th class="text-center">{{ __('titles.status') }}</th>
                                <th class="text-center">{{ __('titles.actions') }}</th>
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
                                    <a href="{{ route('technision.issue.show',$ticket->id) }}" class="btn btn-primary btn-outline btn-sm"> <i class="fa fa-eye"></i> {{ __('titles.view') }}</a>
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