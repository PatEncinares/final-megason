@extends('layouts.dashboard.main')

@section('content')
    <main>
        <div class="container-fluid" id="app">
            <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px"
                    src="{{ asset('assets/quick_links/patient.png') }}" alt="Patient Management">Patient Management</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Patient Information</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Patients Information
                </div>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                        <button onclick="window.print()" class="btn btn-info  d-print-none" style="margin-bottom: 10px;"><i
                                class="fa fa-print"></i> Print</button> <br>
                        <h2 style="color:#3D6B07!important">Patient Medical Record</h2>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <h5 style="color:#3D6B07!important">Patient Information</h5>
                                <h6><strong>{{ $data['patientAccount']['name'] }}</strong></h6>
                                <h5 style="color:#3D6B07!important">Mobile Number</h5>
                                <h6><strong>{{ $data['patientDetail']['mobile_number'] }}</strong></h6>
                                <h5 style="color:#3D6B07!important">Address</h5>
                                <h6><strong>{{ $data['patientDetail']['address'] }}</strong></h6>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5 style="color:#3D6B07!important">Email</h5>
                                <h6><strong>{{ $data['patientAccount']['email'] }}</strong></h6>
                                @php
                                    use Carbon\Carbon;
                                    $dob = $data['patientDetail']['date_of_birth'];
                                    $age = $dob ? Carbon::parse($dob)->age : 'N/A';
                                @endphp
                                <h5 style="color:#3D6B07!important">Age</h5>
                                <h6><strong>{{ $age }} years old</strong></h6>
                                <h5 style="color:#3D6B07!important">Civil Status</h5>
                                @php
                                    use Illuminate\Support\Str;
                                @endphp
                                <h6><strong>{{ Str::ucfirst($data['patientDetail']['civil_status']) }}</strong></h6>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <h5 style="color:#3D6B07!important">Birth Date</h5>
                                <h6><strong>{{ Carbon::parse($data['patientDetail']['date_of_birth'])->format('F d, Y') }}</strong>
                                </h6>
                                <h5 style="color:#3D6B07!important">Weight (kg)</h5>
                                <h6><strong>{{ $data['patientDetail']['weight'] }}</strong></h6>
                                <h5 style="color:#3D6B07!important">Height (cm)</h5>
                                <h6><strong>{{ $data['patientDetail']['weight'] }}</strong></h6>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h4 style="color:red">In Case of Emergency</h4>
                            <hr style="border: 1px solid red;">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <h6 style="color:#3D6B07!important"><strong>Name</strong></h6>
                            <h6><strong>{{ $data['patientDetail']['emergency_name'] }}</strong></h6>
                            <h6 style="color:#3D6B07!important"><strong>Home Phone</strong></h6>
                            <h6><strong>{{ $data['patientDetail']['emergency_number'] }}</strong></h6>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <h6 style="color:#3D6B07!important"><strong>Address</strong></h6>
                            <h6><strong>{{ $data['patientDetail']['emergency_address'] }}</strong></h6>
                        </div>
                    </div>
                    <br><br>
                    <div class="row" style="break-after:page">
                        <div class="col-lg-12 col-md-12">
                            <h4 style="color:#3D6B07!important">General Medical History</h4>
                            @if (Auth::user()->type == 2 || Auth::user()->type == 8)
                                <a href="{{ route('create-medical-history', $data['patientDetail']['id']) }}"><button
                                        class="btn btn-info pull-right"><i class="fa fa-plus"></i> Create New</button></a>
                            @endif
                            <hr style="border: 1px solid #3D6B07;">
                        </div>
                        @if ($data['medicalHistory']->count())
                            @foreach ($data['medicalHistory'] as $history)
                                <div class="col-lg-12">
                                    <p>
                                        <strong>Complains :</strong> {{ $history['complains'] }} <br>
                                        <strong>Diagnosis :</strong> {{ $history['diagnosis'] }} <br>
                                        <strong>Treatment :</strong> {{ $history['treatment'] }} <br>
                                        <strong>Date of last visit :</strong>
                                        {{ \Carbon\Carbon::parse($history['last_visit'])->format('F d, Y') }} <br>
                                        <strong>Next Visit :</strong>
                                        {{ \Carbon\Carbon::parse($history['next_visit'])->format('F d, Y') }} <br>
                                        <strong>Time:</strong> {{ \Carbon\Carbon::createFromFormat('H:i:s', $history['time'])->format('g:i A') }} <br>
                                        <strong>Attending Doctor :</strong>
                                        {{ optional($history->doctor)->name ?? 'Doctor is no longer active' }} <br> <br>

                                    </p>
                                    <hr>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12">
                                <center>No records to show.</center>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h4 style="color:#3D6B07!important">Lab Results</h4>
                            <hr style="border: 1px solid #3D6B07;">
                        </div>
                        <div class="col-lg-12 col-md-12">
                            @if (count($data['labResults']))
                                @foreach ($data['labResults'] as $labResult)
                                    <show-lab-result :data="{{ $labResult }}"></show-lab-result>
                                @endforeach
                            @else
                                <div class="col-lg-12">
                                    <center>No records to show.</center>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- <patients-list :user_data="user_data"></patients-list> --}}
        </div>
    </main>
    @include('layouts.dashboard.footer')
@endsection
