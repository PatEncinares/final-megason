@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4">Patient Profile</h1>
        <ol class="breadcrumb mb-4">
        	<patient-profile></patient-profile>
        </ol>
        <patients-list :user_data="user_data"></patients-list>
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
