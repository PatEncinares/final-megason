@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/patient.png') }}" alt="Patient Management"> Patient Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Patients List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Patients List
            </div>
            <div class="card-body">
                <sweet-modal ref="editPatient">Edit patient</sweet-modal>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Patient ID</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Civil Status</th>
                                <th>Age</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Attending Doctor</th>
                            </tr>
                        </thead>
                        
                        @if($data['patients'])
                            <tbody>
                                @foreach($data['patients'] as $patient)
                                
                                <tr>
                                    <td>
                                        <a href="{{ route('view-patient', $patient['id'] ) }}"><button class="btn btn-info" title="View Details"><i class="fa fa-file"></i> Medical History</button></a>
                                        <a href="{{ route('edit-patient', $patient['id'] ) }}"><button class="btn btn-info" title="Edit"><i class="fa fa-edit"></i></button></a>
                                        @if($patient['user']->id != Auth::user()->id)
                                            @if(Auth::user()->type != 2 && Auth::user()->type != 3 && Auth::user()->type != 4 && Auth::user()->type != 8)
                                                <!-- <a href="{{ route('delete-patient', $patient['id']) }}"><button class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></button></a> -->
                                                <a href="#"><button data-toggle="modal" data-target="#exampleModal" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></button></a>
                                            @endif
                                        @endif

                                    </td>
                                    <td>{{ 'PT' . str_pad($patient->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $patient['user']['name'] }}</td>
                                    <td>{{ ucfirst(strtolower($patient['gender'])) }}</td>
                                    <td>{{ ucfirst(strtolower($patient['civil_status'])) }}</td>
                                    <td>{{ $patient['age'] }}</td>
                                    <td>{{ $patient['mobile_number'] }}</td>
                                    <td>{{ $patient['address'] }}</td>
                                    <td>
                                        @foreach($patient['appointments'] as $appoint)
                                        @if($appoint->status == 1)
                                            @if($appoint->doctor)
                                                {{ $appoint->doctor->name }} - {{ date('F d, Y', strtotime($appoint->date)) }}<br>
                                            @else
                                                Doctor is no longer active<br>
                                            @endif
                                        @endif
                                    @endforeach
                                    </td>
                                </tr>
                                 <!-- Modal -->
                                   @include('patient-management.delete_list')
                                @endforeach
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
        {{-- <patients-list :user_data="user_data"></patients-list> --}}
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
