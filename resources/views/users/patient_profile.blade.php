@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Patient Profile</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Patient Profile
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="{{ route('edit-profile') }}" class="btn btn-info"><i class="fa fa-edit"></i> Edit Profile</a>
                    </div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data['users'])
                            @foreach($data['users'] as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('edit-user',$user->id) }}"><button class="btn btn-info" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
                                        <a href="{{ route('delete-user', $user->id) }}"><button class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->usertype->name }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
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
