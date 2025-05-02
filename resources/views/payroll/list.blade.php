@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/human_resource.JPG') }}" alt="Patient Management">Payroll</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Payroll List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Payroll List
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>Pay Period</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['payroll'] as $payroll)
                        <tr>
                            <td>
                                <a href="{{ route('get-payroll', $payroll['id'] ) }}"><button class="btn btn-info" title="View Payroll"><i class="fa fa-file"></i> View</button></a>
                            </td>
                            <td>{{ $payroll->employee->user->name }}</td>
                            <td>{{ $payroll->employee->user->usertype->name }}</td>
                            <td>{{ $payroll->pay_period }}</td>
                            <td>{{ $payroll->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
