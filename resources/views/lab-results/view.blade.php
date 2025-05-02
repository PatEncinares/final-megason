@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4 d-print-none"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/microscope.JPG') }}" alt="Patient Management">Laboratory</h1>
        <ol class="breadcrumb mb-4 d-print-none">
            <li class="breadcrumb-item active">Lab Results</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header d-print-none">
                <i class="fas fa-table mr-1"></i>
                Lab Results Details
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <button onclick="window.print()" class="btn btn-info  d-print-none" style="margin-bottom: 10px;"><i class="fa fa-print"></i> Print</button> <br>
                    {{-- {{ dd($data['labResult']) }} --}}
                    <show-lab-result :data="{{ $data['labResult'][0] }}"></show-lab-result>
                </div>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
