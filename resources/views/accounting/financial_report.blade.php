@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/accounting.JPG') }}" alt="Patient Management">Accounting</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Financial Report</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Financial Report for FY - {{ \Carbon\Carbon::now()->year }}
            </div>
            <div class="card-body">
                <div class="form-group">
                    <button class="btn btn-info  d-print-none" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                </div>
                
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction Number</th>
                            <th>Transaction Date</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Doctor's Fee</th>
                            <th>Lab Fee</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($data['transactions'])
                        @foreach($data['transactions'] as $transaction)
                            <tr>
                                <td><a href="{{ route('view-transaction',$transaction->id) }}">{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</a></td>
                                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                <td>{{ $transaction->patient->name }}</td>
                                <td>{{ $transaction->doctor ? $transaction->doctor->name : 'Doctor no longer active' }}</td>
                                <td>{{ $transaction->doctor_fee }}</td>
                                <td>{{ $transaction->lab_fee }}</td>
                                <td>{{ $transaction->total_amount }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="6" style="text-align: right">Total Sales</th>
                            <th>{{ $data['total'] }}</th>
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
</main>
@include('layouts.dashboard.footer')
@endsection
