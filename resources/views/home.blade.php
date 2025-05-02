@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/home.jpg') }}" alt="Patient Management"> Home</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-12">
                <h4>Welcome {{ $data['user'][0]->name }}</h4>
                {{-- @if(Auth::user()->type != 1 && Auth::user()->type != 2 && Auth::user()->type != 3)
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                      <a href="{{ route('time-in') }}"><button type="button" class="btn btn-secondary"><i class="fas fa-clock"></i> TIME IN</button></a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                      <a href="{{ route('time-out') }}"><button type="button" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> TIME OUT</button></a>
                    </div>
                </div>
                @endif --}}
                <hr>
                <h5>Quick Links</h5>
                <div class="row">
                    @if(in_array("profile",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/profile.JPG') }}" alt="Patient Management">
                                    Profile
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    @if(Auth::user()->type == 2)
                                        <a class="small stretched-link" href="{{ route('get-doctor-list') }}">View</a>
                                    @elseif(Auth::user()->type == 3)
                                        <a class="small stretched-link" href="{{ route('patients-list') }}">View</a>
                                    @endif
                                    
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if(in_array("patient_management",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/patient.png') }}" alt="Patient Management">
                                    Patient Management
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{ route('patients-list') }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array("appointments",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">
                                    Appointments
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{ url('/appointments') }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array("doctors_management",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/doctor.png') }}" alt="Patient Management">
                                    Doctors Management
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  url('/doctors-list')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if((Auth::user()->type == 7))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/transaction.JPG') }}" alt="Patient Management">
                                    Transactions
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  route('get-transactions-list')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array("laboratory_management",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/microscope.JPG') }}" alt="Patient Management">
                                    Laboratory
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  route('lab-results-list')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- @if(in_array("hr",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/human_resource.JPG') }}" alt="Patient Management">
                                    Human Resource
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  route('get-employees-list')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif --}}

                    @if(in_array("inventory",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">
                                    Inventory
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  route('get-inventory-list')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array("accounting",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/accounting.JPG') }}" alt="Patient Management">
                                    Accounting
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  route('financial-report')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(in_array("user_accounts",$data['permissions']))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/user_management.JPG') }}" alt="Patient Management">
                                    User Accounts
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small stretched-link" href="{{  route('user-list')  }}">View</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
            

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
