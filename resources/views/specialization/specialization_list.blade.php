@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/settings.JPG') }}" alt="Patient Management">User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Specialization List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Specialization List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="{{ route('create-specialization') }}" class="btn btn-info"><i class="fa fa-plus"></i> New Specialization</a>
                    </div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Specialization Name</th>
                                <th>Description</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data['specialization'])
                            @foreach($data['specialization'] as $Specialization)
                                <tr>
                                    <td>
                                        <a href="{{ route('edit-specialization',$Specialization->id) }}"><button class="btn btn-info" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
                                        <a href="{{ route('delete-specialization', $Specialization->id) }}"><button class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
                                    </td>
                                    <td>{{ $Specialization->name }}</td>
                                    <td>{{ $Specialization->description }}</td>
                                    <td>{{ $Specialization->created_at->diffForHumans() }}</td>
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
