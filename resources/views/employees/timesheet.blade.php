@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/human_resource.JPG') }}" alt="Patient Management">Timesheet</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Employee Timesheet</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Employee Timesheet            
            </div>
            <div class="card-body">
                <h4>Timesheet for {{ $data['pay_period'] }}</h4>
                <h5>{{ $data['employee'][0]['user']['name'] }} - {{ $data['employee'][0]['user']['usertype']['name'] }}</h5>
                <br>
                <div class="table-responsive">
                    @if($data['payroll_generated'] === 'false')
                        <form action="{{ route('save-payroll') }}" method="post">
                            @csrf
                            <div class="container">
                                <h4>Earnings:</h4><br>
                                <div class="row">
                                    
                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="employee_leave" class="control-label">Paid Leave</label>
                                        <input type="number" placeholder="Days" name="employee_leave" id="employee_leave" class="form-control" required>
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="ot" class="control-label">Overtime</label>
                                        <input step=".01" type="number" placeholder="Hours" name="ot" id="ot" class="form-control" required>
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="rholiday" class="control-label">Regular Holiday</label>
                                        <input type="number" placeholder="Days" name="rholiday" id="rholiday" class="form-control" required>
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="sholiday" class="control-label">Special Holiday</label>
                                        <input type="number" placeholder="Days" name="sholiday" id="sholiday" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="tmonth" class="control-label">13th Month</label>
                                        <input type="number" placeholder="Months" name="tmonth" id="tmonth" class="form-control" required>
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="bonus" class="control-label">Bonus</label>
                                        <input step=".01" placeholder="Amount" type="number" name="bonus" id="bonus" class="form-control" required>
                                    </div>
                                </div>
                                <h4>Deductions:</h4><br>
                                <div class="row">
                                    
                                <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="sss" class="control-label">SSS</label>
                                        <input step="any" placeholder="%" type="number" name="sss" id="sss" class="form-control" required>
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="philhealth" class="control-label">Philhealth</label>
                                        <input step="any" placeholder="%" type="number" name="philhealth" id="philhealth" class="form-control" required>
                                    </div>

                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="pagibig" class="control-label">Pag Ibig</label>
                                        <input type="number" placeholder="Amount" name="pagibig" id="pagibig" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group col-lg-4 col-sm-4 col-md-4">
                                        <label for="tax" class="control-label">Tax</label>
                                        <input step="any" placeholder="%" type="number" name="tax" id="tax" class="form-control">
                                    </div>


                                    <input type="hidden" name="employee_id" value="{{ $data['employee'][0]['id'] }}">
                                    <input type="hidden" name="pay_period" value="{{ $data['pay_period'] }}">
                                    <input type="hidden" name="total_hours_worked" value="{{ $data['total_hours_worked'] }}">
                                    <input type="hidden" name="total_days_worked" value="{{ $data['total_days_worked'] }}">
                                    
                                </div>
                                <center><button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Submit Timesheet</button></center> <br>
                            </div>
                                
                            
                        </form>
                    @else
                        <button class="btn btn-info" disabled><i class="fa fa-save"></i> Submit Timesheet</button>
                    @endif
                    <div class="row">
                        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>IN</th>
                                    <th>OUT</th>
                                    <th>Hours Worked</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($data['workdays'])
                                @foreach($data['workdays'] as $workday => $value)
                                @if( $value['IN'] == '' || $value['OUT'] == '')
                                <tr class="table-danger">
                                @else
                                <tr>
                                @endif
                                    <td>{{ $workday }}</td>
                                    <td>{{ ($value['IN'] == '') ? '-- NO TIME IN --' : $value['IN']->format('h:m a') }}</td>
                                    <td>{{ ($value['OUT'] == '') ? '-- NO TIME OUT --' : $value['OUT']->format('h:m a') }}</td>
                                    <td>{{ $value['hourswork'] }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3" style="text-align: right">Total hours</th>
                                    <td>{{ $data['total_hours_worked'] }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" style="text-align: right">Total Days</th>
                                    <td>{{ $data['total_days_worked'] }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            No Records to Show
                                        </center>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
