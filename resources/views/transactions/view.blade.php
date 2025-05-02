@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4 d-print-none"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/transaction.JPG') }}" alt="Patient Management">Transactions</h1>
        <ol class="breadcrumb mb-4 d-print-none">
            <li class="breadcrumb-item active">View Transaction</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header d-print-none">
                <i class="fas fa-table mr-1"></i>
                View Transaction
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <button onclick="window.print()" class="btn btn-info  d-print-none" style="margin-bottom: 10px;"><i class="fa fa-print"></i> Print</button> <br>
                    <div>
                        <h2 class=" d-none d-print-block"><center>Megason Diagnostic Clinics</center></h2>
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
                
                        <div class="row" >
                            <div class="col-lg-6 col-md-6 col-sm-6  d-none d-print-block">
                                <b>MAKATI I: </b> GF Banyan Place Building, 366 JP Rizal St., Brgy. Tejeros, Makati City <br>
                                • Tel Nos : <b>8897-4150 • 7502-3051</b> <br>
                                <b>MAKATI II: </b> 35 JP Rizal ext. Cor. Kamagong St., Brgy. Comembo, Makati City <br>
                                • Tel Nos : <b>8881-5034 • 7239-7537</b> <br>
                                <b>MANDALUYONG: </b> GF The Boni Tower, 602 Boni Ave., Mandaluyong City <br>
                                • Tel Nos : <b>4708-4996 • 7576-3877</b> <br>
                                <b>STA. ROSA: </b> Units 2-3 Levant Business Center, 7656 Market Drive near corner Rizal Blvd., Brgy. Tagapo, Sta Rosa, Laguna <br>
                                • Tel Nos : <b>4708-4996 • 7576-3877</b>
                            </div>
                
                            <div class="col-lg-6 col-md-6 col-sm-6  d-none d-print-block">
                                <b>ALABANG: </b> 2<sup>nd</sup> Floor Erlinda Building, 257 Montillano St., Brgy. Alabang, Muntinlupa City <br>
                                • Tel Nos : <b>8809-9044 • 7906-4724</b> <br>
                                <b>ANTIPOLO: </b> 174B Marcos Highway, Masinag, Brgy. Mayamot, Antipolo City <br>
                                • Tel Nos : <b>8646-6779 • 8871-5665</b> <br>
                                <b>MARIKINA: </b> Unit 23 Alicante Tower, Marquinton Residences, Toyota Ave., Brgy. Sto Niño, Marikina City <br>
                                • Tel Nos : <b>7239-0665 • 8404-9211</b> <br>
                                <b>TAYTAY: </b> #1 Mahinhin cor. Kadalagahan Street, Brgy. Dolores, Taytay, Rizal <br>
                                • Tel Nos : <b>8475-5269</b>
                                <br><br><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <center><h2>Official Receipt</h2></center>

                                <b>Date: </b>{{ \Carbon\Carbon::now()->format('M d, Y') }} 
                                <span style="float:right;"><b>Receipt #: </b>{{ str_pad($data['transaction'][0]['id'], 6, '0', STR_PAD_LEFT) }}</span>
                                <br>
                                <b>Patient's Name: </b> {{ $data['transaction'][0]['patient']['name'] }} <br>
                                <b>Address: </b> {{ $data['transaction'][0]['patient']['patientDetails'][0]['address']  }} <br>
                                <b>Contact Number: </b> {{ $data['transaction'][0]['patient']['patientDetails'][0]['mobile_number']  }}</b>
                                <br><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
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
                                            <th colspan="3">Doctor's fee: </th>
                                            <td>{{ $data['transaction'][0]['doctor_fee'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Discount (Senior/PWD): 20% </th>
                                            <td>{{ $data['discount_amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Value Added Tax (VAT): 12%</th>
                                            <td>{{ $data['tax_amount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" style="text-align: right">Subtotal</th>
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
