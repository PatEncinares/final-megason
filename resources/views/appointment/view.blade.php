@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">Appointment Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">View Appointment</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Appointment Details
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Period</th>
                            </tr>
                        </thead>
                        @if($data['appointments'])
                            <tbody>
                                <tr>
                                    <td>{{ $data['appointments']['patient']['name'] }}</td>
                                    <td>{{ $data['appointments']['doctor']['name'] }}</td>
                                    <td>{{ $data['appointments']['date'] }}</td>
                                    <td>{{ $data['appointments']['real_time'] }}</td>
                                    <td>{{ $data['appointments']['time'] }}</td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="6"><center>No records to show.</center></td>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
