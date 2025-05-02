@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/microscope.JPG') }}" alt="Patient Management">Laboratory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Lab Results List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Lab Results List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="{{ route('new-lab-result') }}" class="btn btn-info"><i class="fa fa-file"></i> Create Lab Result</a>
                    </div>
                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Patient Name</th>
                                <th>Procedure</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data['labResults']->count())
                            @foreach($data['labResults'] as $labResult)
                            <tr>
                                <td>
                                    <a href="{{ route('view-lab-result',[$labResult->id, $labResult->procedure->id]) }}"><button class="btn btn-info" title="View Details"><i class="fa fa-file"></i></button></a>
                                </td>
                                <td>{{ $labResult->patient->name }}</td>
                                <td>{{ $labResult->procedure->name }}</td>
                                <td>{{ $labResult->created_at }}</td>
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
