@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/user_management.JPG') }}" alt="Patient Management">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Activity Log</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Activity Log
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Date and Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['activities'] as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                {{-- <td>{{ $activity->user->name }}</td> --}}
                                <td>{{ $activity->user ? $activity->user->name : 'User Deleted' }}</td>
                                <td>{{ $activity->activity }}</td>
                                <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('M d, Y, h:m a')}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
