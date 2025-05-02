@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/settings.JPG') }}" alt="Patient Management">Settings</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Settings</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Edit Settings
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-settings') }}" aria-label="{{ __('Create Inventory') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="am_limit" class="col-md-4 col-form-label text-md-right">{{ __('Morning Schedule Limit:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="am_limit" id="" class="form-control" required value="{{ $data['settings']->am_limit }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pm_limit" class="col-md-4 col-form-label text-md-right">{{ __('Afternoon Schedule Limit:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="pm_limit" id="" class="form-control" required value="{{ $data['settings']->pm_limit }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
