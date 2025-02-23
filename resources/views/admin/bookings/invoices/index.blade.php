@extends('layouts.admin')

@section('title')
    Factuurbeheer
@endsection

@section('content')

<!-- Pagina -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">{{ ucfirst(env('business_title')) }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Beheerdersdashboard</li>
            <li class="breadcrumb-item"><a href="#">Facturen</a></li>
            <li class="breadcrumb-item active">Factuuroverzicht</li>
        </ol>
    </div>

    <div class="page-content container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Factuuroverzicht voor boekingsaanvraag nr: 
                    <span class="text-info">{{ $enquiry->enquiry_no }}</span>
                </h3>
            </div>
            <div class="panel-body mt-5">

                @if(session()->has('success'))
                    <div class="alert alert-success mt-6">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <!-- Factuurtabel -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Huurder</th>
                            <th>Woning</th>
                            <th class="text-center">Huurperiode</th>
                            <th class="text-center">Bedrag (€)</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">
                                    {{ !empty($enquiry->tenant->first_name) && !empty($enquiry->tenant->last_name) 
                                    ? $enquiry->tenant->first_name.' '.$enquiry->tenant->last_name : '' }}
                                </td>
                                <td>{{ $invoice->property->title_en ?? '' }}</td>
                                <td class="text-center">
                                    {{ date_format(date_create($invoice->from_date), 'd-M-Y') }} 
                                    tot 
                                    {{ date_format(date_create($invoice->till_date), 'd-M-Y') }}
                                </td>
                                <td class="text-center">
                                    €{{ number_format($invoice->amount, 2) }}
                                </td>
                                <td class="text-center">
                                    @if($invoice->status == 'paid')
                                        <span class="badge badge-success font-weight-100">Betaald</span>
                                    @else
                                        <span class="badge badge-warning font-weight-100">Openstaand</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Acties <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if($invoice->status == 'unpaid')
                                                <a type="button" class="dropdown-item btn btn-primary btn-outline btn-reply"
                                                    href="{{ route('admin.invoice.pay', $invoice->id) }}"
                                                    onClick="return confirm('Weet u zeker dat u deze factuur wilt betalen?');">
                                                    <i class="icon fa-money" aria-hidden="true" style="font-size: 15px;"></i> Betalen
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Antwoord op aanvraag - Modal -->
                <div class="modal fade update-modal" id="examplePositionCenter" aria-hidden="true" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-simple modal-center">
                        <form class="form-horizontal" action="{{ route('admin.booking.enquiry.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="e_id" value="">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Sluiten">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Reageren op aanvraag</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-control-label">Upload bestand voor verhuurder</label>
                                        <input type="file" name="landlord_file_name" class="form-control" accept=".docx, .pdf">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Upload bestand voor huurder</label>
                                        <input type="file" name="tenant_file_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Status bijwerken</label>
                                        <select name="status" class="form-control">
                                            <option value="">Maak een keuze</option>
                                            <option value="notapproved">Niet goedgekeurd</option>
                                            <option value="approved">Goedgekeurd</option>
                                            <option value="started">Gestart</option>
                                            <option value="end">Beëindigd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                                    <button type="submit" class="btn btn-primary">Opslaan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Einde Modal -->

            </div>
        </div>
    </div>
</div>
<!-- Einde Pagina -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.table').dataTable();
    });
</script>
@endsection
