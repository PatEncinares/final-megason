@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/doctor.png') }}" alt="Patient Management">Doctors Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Doctors List</li>
        </ol>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Doctors List
            </div>
            <div class="card-body">
                <sweet-modal ref="editDoctor">Edit Doctor</sweet-modal>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Fullname</th>
                                {{-- <th>Doctor ID</th> --}}
                                {{-- <th>Gender</th> --}}
                                <th>Specialization</th>
                                {{-- <th>Address</th> --}}
                            </tr>
                        </thead>

                        @if($data['doctors']->count())
                            <tbody>
                                @foreach($data['doctors'] as $doctor)
                     
                                <tr>
                                    <td>
                                        <a href="{{ route('edit-doctor', $doctor['id'] ) }}"><button class="btn btn-info" title="Edit"><i class="fa fa-edit"></i>Edit</button></a>
                                        @if($doctor['user_id'] != Auth::user()->id)
                                            <button class="btn btn-danger" title="Delete"
                                                onclick="confirmDelete({{ $doctor['id'] }})">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ ($doctor['gender'] === 'male' ? 'Dr.' : 'Dra.') . ' ' . $doctor['fullname'] }}</td>
                                    {{-- <td>{{ 'DC' . str_pad($doctor->id, 6, '0', STR_PAD_LEFT) }}</td> --}}
                                    {{-- <td>{{ ucfirst($doctor['gender']) }}</td> --}}
                                    <td>{{ $doctor->specialization ? $doctor->specialization->name : 'N/A' }}</td>
                                    {{-- <td>{{ $doctor['address'] }}</td> --}}
                                </tr>
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

    </div>
</main>
<script>
    function confirmDelete(doctorId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the doctor.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/doctors-list/delete/${doctorId}`;
            }
        });
    }
</script>
@include('layouts.dashboard.footer')
@endsection
