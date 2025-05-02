@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/transaction.JPG') }}" alt="Patient Management">Transactions</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Transaction List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Transaction List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="{{ route('create-transaction') }}" class="btn btn-info"><i class="fa fa-plus"></i> New Transaction</a>
                    </div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Transaction Number</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Appointment Date</th>
                                <th>Doctor's Fee</th>
                                <th>Lab Fee</th>
                                <th>Total Amount</th>
                                <th>Discount (%)</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data['transactions'])
                            @foreach($data['transactions'] as $transaction)
                                <tr>
                                    <td>
                                        <a href="{{ route('view-transaction', $transaction->id) }}"><button class="btn btn-info"><i class="fa fa-file"></i></button></a>
                                        <a href="{{ route('edit-transaction',$transaction->id) }}"><button class="btn btn-info" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
                                        <a href="{{ route('delete-transaction', $transaction->id) }}"><button class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
                                        @if($transaction->status != 'paid')
                                            <a href="{{ route('mark-as-paid', $transaction->id) }}"><button class="btn btn-info" title="Mark as Paid"><i class="fa fa-coins"></i> Mark Paid</button></a>
                                        @else
                                            <a href="{{ route('mark-as-paid', $transaction->id) }}"><button class="btn btn-info" title="Mark as Paid" disabled><i class="fa fa-coins"></i> Mark Paid</button></a>
                                        @endif
                                    </td>
                                    <td>{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $transaction->patient->name }}</td>
                                    <td>{{ $transaction->doctor->name }}</td>
                                    <td>{{ $transaction->appointment->date }}</td>
                                    <td>{{ $transaction->doctor_fee }}</td>
                                    <td>{{ $transaction->lab_fee }}</td>
                                    <td>{{ $transaction->total_amount }}</td>
                                    <td>{{ ($transaction->discount) ? $transaction->discount : '0' }}%</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
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
</main>
@include('layouts.dashboard.footer')
@endsection
