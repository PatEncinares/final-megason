@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/human_resource.JPG') }}" alt="Patient Management"> Employees</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Daily Rate</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Edit daily rate for {{ $data['employee'][0]['user']['name'] }}            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-daily-rate') }}" aria-label="{{ __('Update Daily Rate') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="employee_id" value="{{ $data['employee'][0]['id'] }}">
                    <div class="form-group row">
                        <label for="daily_rate" class="col-md-4 col-form-label text-md-right">{{ __('Daily Rate:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="daily_rate" id="daily_rate" class="form-control" required value="{{ $data['employee'][0]['daily_rate'] }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update User</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
