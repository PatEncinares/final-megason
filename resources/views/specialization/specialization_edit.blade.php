@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/settings.JPG') }}" alt="Patient Management">Inventory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit specialization</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Edit specialization
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-specialization') }}" aria-label="{{ __('Create specialization') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row">
                        <input type="hidden" name="specialization_id" value="{{ $data['specialization'][0]->id }}">
                        <label for="specialization_name" class="col-md-4 col-form-label text-md-right">{{ __('Enter specialization Name:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="specialization_name" id="" class="form-control" value="{{ $data['specialization'][0]->name }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Enter Description:') }}</label>
                    
                        <div class="col-md-6">
                            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $data['specialization'][0]->description }}</textarea>
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
