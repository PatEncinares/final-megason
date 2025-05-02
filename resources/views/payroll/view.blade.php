@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4 d-print-none"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/human_resource.JPG') }}" alt="Patient Management">Payroll</h1>
        <ol class="breadcrumb mb-4 d-print-none">
            <li class="breadcrumb-item active">Employee Payroll</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header d-print-none">
                <i class="fas fa-table mr-1"></i>
                Employee Payroll
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
                        </center>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <br><br>
                                <strong>Name: </strong> {{ $data['payroll'][0]['employee']['user']['name'] }} <br>
                                <strong>Employee ID: </strong> {{ str_pad($data['payroll'][0]['employee']['id'], 6, '0', STR_PAD_LEFT) }} <br>
                                <strong>Semi-monthly Pay Rate: </strong> {{ $data['payroll'][0]['employee']['daily_rate'] * 22 / 2 }} <br>
                                <strong>Daily Pay Rate: </strong> {{ $data['payroll'][0]['employee']['daily_rate'] }} <br>
                            </div>
                            <center><h4>Payslip Summary</h4></center>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Total Hours Paid :</th>
                                    <td>{{ $data['payroll'][0]['total_pay'] }}</td>
                                </tr>

                                <tr>
                                <th>EARNINGS</th>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th>Paid Leave :</th>
                                    <td>{{ $data['payroll'][0]['employee_leave'] * $data['payroll'][0]['employee']['daily_rate'] }}</td>
                                </tr>
                                <tr>
                                    <th>Overtime :</th>
                                    <td>{{ $data['payroll'][0]['ot'] * ($data['payroll'][0]['employee']['daily_rate'] / 8) }}</td>
                                </tr>
                                <tr>
                                    <th>Regular Holiday :</th>
                                    <td>{{ $data['payroll'][0]['rholiday'] * ($data['payroll'][0]['employee']['daily_rate']) }}</td>
                                </tr>

                                <tr>
                                    <th>Special Holiday :</th>
                                    <td>{{ ($data['payroll'][0]['sholiday'] * ($data['payroll'][0]['employee']['daily_rate']) * .3) }}</td>
                                </tr>
                                <tr>
                                    <th>13th Month Pay :</th>
                                    <td>{{ ($data['payroll'][0]['tmonth'] * $data['payroll'][0]['employee']['daily_rate'])/12 }}</td>
                                </tr>
                                <tr>
                                    <th>Bonus :</th>
                                    <td>{{ $data['payroll'][0]['bonus'] }}</td>
                                </tr>
                                <tr>
                                    <th>GROSS PAY :</th>
                                    <td>{{ $data['payroll'][0]['gross_pay'] }}</td>
                                </tr>
                                <tr>
                                    <th>DEDUCTIONS</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>SSS :</th>
                                    <td>{{ $data['payroll'][0]['sss'] * $data['payroll'][0]['employee']['daily_rate'] }}</td>
                                </tr>
                                <tr>
                                    <th>Philhealth :</th>
                                    <td>{{ $data['payroll'][0]['philhealth'] * $data['payroll'][0]['employee']['daily_rate'] }}</td>
                                </tr>
                                <tr>
                                    <th>Pag Ibig :</th>
                                    <td>{{ $data['payroll'][0]['pagibig'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tax :</th>
                                    <td>{{ $data['payroll'][0]['tax'] * $data['payroll'][0]['employee']['daily_rate'] }}</td>
                                </tr>
                                <tr>
                                    <th>Total Deductions :</th>
                                    <td>{{ $data['payroll'][0]['total_deduction'] }}</td>
                                </tr>
                                <tr>
                                    <th>Net Pay:</th>
                                    <td><b>{{ $data['payroll'][0]['net_pay'] }}</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
