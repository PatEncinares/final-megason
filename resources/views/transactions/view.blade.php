@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4 d-print-none">
            <img class="card-img-top img-thumbnail" style="height: 60px; width: 60px"
                 src="{{ asset('assets/quick_links/transaction.JPG') }}" alt="Patient Management">
            Transactions
        </h1>
        <ol class="breadcrumb mb-4 d-print-none">
            <li class="breadcrumb-item active">View Transaction</li>
        </ol>

        @if(session('success'))
            <div class="alert alert-success d-print-none">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header d-print-none">
                <i class="fas fa-table mr-1"></i>
                View Transaction
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <button onclick="window.print()" class="btn btn-info d-print-none mb-3">
                        <i class="fa fa-print"></i> Print
                    </button>

                    @if($data['transaction'][0]['status'] != 'paid')
                    <form action="{{ route('mark-as-paid') }}" method="POST" class="d-print-none mb-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['transaction'][0]['id'] }}">
                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to mark this transaction as paid?')">
                            <i class="fa fa-coins"></i> Mark as Paid
                        </button>
                    </form>
                @endif

                    <div>
                        <h2 class="d-none d-print-block text-center">Megason Diagnostic Clinics</h2>

                        <center>
                            <ul class="d-none d-print-block" style="list-style-type: none!important">
                                <strong>
                                    <li style="display:inline">XRAY •</li>
                                    <li style="display:inline">ULTRASOUND •</li>
                                    <li style="display:inline">LABORATORY •</li>
                                    <li style="display:inline">ECG •</li>
                                    <li style="display:inline">2-D ECHO •</li>
                                    <li style="display:inline">MOBILE CLINIC •</li>
                                    <li style="display:inline">DRUG TESTING</li>
                                </strong>
                            </ul>
                            <ul class="d-none d-print-block" style="list-style-type: none!important">
                                <strong>
                                    <li style="display:inline">PRE-EMPLOYMENT / ANNUAL MEDICAL EXAM •</li>
                                    <li style="display:inline">HEALTH/MEDICAL CERTIFICATE •</li>
                                    <li style="display:inline">EXECUTIVE CHECK-UP</li>
                                </strong>
                            </ul>
                        </center>

                        {{-- Clinic Addresses (print only) --}}
                        <div class="row">
                            <div class="col-lg-6 d-none d-print-block">
                                <b>MAKATI I:</b> GF Banyan Place Building, 366 JP Rizal St., Brgy. Tejeros, Makati City <br>
                                <b>MAKATI II:</b> 35 JP Rizal ext. Cor. Kamagong St., Brgy. Comembo, Makati City <br>
                                <b>MANDALUYONG:</b> GF The Boni Tower, 602 Boni Ave., Mandaluyong City <br>
                                <b>STA. ROSA:</b> Units 2-3 Levant Business Center, Brgy. Tagapo, Sta Rosa, Laguna <br>
                            </div>
                            <div class="col-lg-6 d-none d-print-block">
                                <b>ALABANG:</b> 2nd Flr Erlinda Bldg, 257 Montillano St., Alabang, Muntinlupa <br>
                                <b>ANTIPOLO:</b> 174B Marcos Highway, Masinag, Brgy. Mayamot <br>
                                <b>MARIKINA:</b> Unit 23 Alicante Tower, Marquinton Residences, Marikina City <br>
                                <b>TAYTAY:</b> #1 Mahinhin cor. Kadalagahan Street, Brgy. Dolores, Taytay, Rizal <br><br><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <center><h2>Official Receipt</h2></center>
                                <b>Date:</b> {{ \Carbon\Carbon::now()->format('M d, Y') }}
                                <span class="float-right"><b>Receipt #:</b> {{ str_pad($data['transaction'][0]['id'], 6, '0', STR_PAD_LEFT) }}</span>
                                <br>
                                <b>Patient's Name:</b> {{ $data['transaction'][0]['patient']['name'] }} <br>
                                <b>Address:</b> {{ $data['transaction'][0]['patient']['patientDetails'][0]['address'] }} <br>
                                <b>Contact Number:</b> {{ $data['transaction'][0]['patient']['patientDetails'][0]['mobile_number'] }}
                                <br><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Services</th>
                                            <th>Qty.</th>
                                            <th>Rate</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['transaction'][0]['procedures'] as $procedure)
                                            <tr>
                                                <td>{{ $procedure->name }}</td>
                                                <td>1</td>
                                                <td>{{ $procedure->price }}</td>
                                                <td>{{ $procedure->price }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th colspan="3">Doctor's fee:</th>
                                            <td>{{ $data['transaction'][0]['doctor_fee'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Discount (Senior/PWD): 20%</th>
                                            <td>{{ $data['discount_amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Value Added Tax (VAT): 12%</th>
                                            <td>{{ $data['tax_amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right">Subtotal</th>
                                            <td>{{ $data['subtotal'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
