@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/settings.JPG') }}" alt="Patient Management">Settings</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Settings</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Set Schedule Limit
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Morning Schedule Limit</th>
                            <th>PM Schedule Limit</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($data['settings'])
                            <tr>
                                <td>
                                    <a href="{{ route('edit-settings') }}"><button class="btn btn-info" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
                                </td>
                                <td>{{ $data['settings']->am_limit }}</td>
                                <td>{{ $data['settings']->pm_limit }}</td>
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
