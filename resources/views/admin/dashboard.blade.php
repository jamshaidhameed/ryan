@extends('layouts.admin')
@section('title')
 Admin Dashboard
@endsection
@section('content')
<!-- Page -->
<div class="page">
  <div class="page-header">
    <h1 class="page-title font-size-26 font-weight-100 text-primary">Dashboard </h1>
  </div>

  <div class="page-content container-fluid">
    <p class="text text-info">{{ ucfirst(env('business_title'))}} </p>
    <div class="row">
      <div class="col-xl-3 col-md-6 info-panel">
        <div class="card card-shadow">
          <div class="card-block bg-white p-20">
            <button type="button" class="btn btn-floating btn-sm btn-warning">
              <i class="icon wb-shopping-cart"></i>
            </button>
            <span class="ml-15 font-weight-400">Total Properties</span>
            <div class="content-text text-center mb-0">
              <i class="text-danger icon wb-triangle-up font-size-20">
            </i>
              <span class="font-size-40 font-weight-100">{{ \App\Models\Properties::where('status',1)->get()->count()}}</span>
              <p class="blue-grey-400 font-weight-100 m-0" > <a href="{{ route('admin.properties') }}">More</a> </p>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 info-panel">
        <div class="card card-shadow">
          <div class="card-block bg-white p-20">
            <button type="button" class="btn btn-floating btn-sm btn-danger">
              <i class="icon fa-mortar-board"></i>
            </button>
            <span class="ml-15 font-weight-400">Total Tenants</span>
            <div class="content-text text-center mb-0">
              <i class="text-success icon wb-triangle-down font-size-20">
            </i>
              <span class="font-size-40 font-weight-100">{{ \App\Models\User::where('role','tenant')->get()->count()}}</span>
                <p class="blue-grey-400 font-weight-100 m-0" > <a href="{{ route('admin.tenant.list') }}">More</a> </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 info-panel">
        <div class="card card-shadow">
          <div class="card-block bg-white p-20">
            <button type="button" class="btn btn-floating btn-sm btn-success">
              <i class="icon wb-book"></i>
            </button>
            <span class="ml-15 font-weight-400">Total Landlords</span>
            <div class="content-text text-center mb-0">
              <i class="text-danger icon wb-triangle-up font-size-20">
            </i>
              <span class="font-size-40 font-weight-100">{{ \App\Models\User::where('role','landlord')->get()->count()}}</span>
              <p class="blue-grey-400 font-weight-100 m-0" > <a href="{{ route('admin.landlord.list') }}">More</a> </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 info-panel">
        <div class="card card-shadow">
          <div class="card-block bg-white p-20">
            <button type="button" class="btn btn-floating btn-sm btn-primary">
              <i class="icon wb-user"></i>
            </button>
            <span class="ml-15 font-weight-400">Total Technicians</span>
            <div class="content-text text-center mb-0">
              <i class="text-danger icon wb-triangle-up font-size-20">
            </i>
              <span class="font-size-40 font-weight-100">{{ \App\Models\User::where('role','technision')->get()->count()}}</span>
              <p class="blue-grey-400 font-weight-100 m-0" > <a href="{{ route('admin.technision.list') }}">More</a> </p>
            </div>
          </div>
        </div>
      </div>
      <!-- End First Row -->

      <!-- second Row -->
      <!-- <div class="col-12" id="ecommerceChartView">
        <div class="card card-shadow">
          <div class="card-header card-header-transparent py-20">
            <div class="btn-group dropdown">
              <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS SALES</a>
              <div class="dropdown-menu animate" role="menu">
                <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                <a class="dropdown-item" href="#" role="menuitem">profit</a>
              </div>
            </div>
            <ul class="nav nav-pills nav-pills-rounded chart-action">
              <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content bg-white p-20">
            <div class="ct-chart tab-pane active" id="scoreLineToDay"></div>
            <div class="ct-chart tab-pane" id="scoreLineToWeek"></div>
            <div class="ct-chart tab-pane" id="scoreLineToMonth"></div>
          </div>
        </div>
      </div> -->
      <!-- End Second Row -->

      <!-- Third Row -->
      <!-- Third Left -->
    
      <!-- End Third Left -->

      <!-- Third Right -->
      <div class="col-lg-12" id="ecommerceRevenue">
        <div class="card card-shadow text-center pt-10">
          <h3 class="card-header card-header-transparent blue-grey-700 font-size-14 mt-0">REVENUE</h3>
          <div class="card-block bg-white">
            <div class="ct-chart barChart"></div>
            <div class="pie-view row">
              <div class="col-6 pie-left text-center">
                <h5 class="blue-grey-500 font-size-14 font-weight-100">GROS REVENUE</h5>
                <p class="font-size-20 blue-grey-700">
                  9,362,74
                </p>
                <div class="pie-progress pie-progress-sm" data-plugin="pieProgress" data-valuemax="100"
                  data-valuemin="0" data-barcolor="#a57afa" data-size="100" data-barsize="4"
                  data-goal="60" aria-valuenow="60" role="progressbar">
                  <span class="pie-progress-number">60%</span>
                </div>
              </div>
              <div class="col-6 pie-right text-center">
                <h5 class="blue-grey-500 font-size-14 font-weight-100">NET REVENUE</h5>
                <p class="font-size-20 blue-grey-700">
                  6,734,58
                </p>
                <div class="pie-progress pie-progress-sm" data-plugin="pieProgress" data-valuemax="100"
                  data-valuemin="0" data-barcolor="#28c0de" data-size="100" data-barsize="4"
                  data-goal="78" aria-valuenow="78" role="progressbar">
                  <span class="pie-progress-number">78%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Third Right -->
      <!-- End Third Row-->
      <div class="row">
       
        
      </div>
    </div>
  </div>
</div>
<!-- End Page -->
@endsection
