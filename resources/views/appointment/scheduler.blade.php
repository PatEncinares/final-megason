@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/appointment.JPG') }}" alt="Patient Management">Appointment Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Schedule</li>
        </ol>
        <schedule :user_data="user_data"></schedule>
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
