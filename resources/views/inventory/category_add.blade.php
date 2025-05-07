@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">Inventory</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add Category</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Add Category
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-category') }}" aria-label="{{ __('Create Category') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="category_name" class="col-md-4 col-form-label text-md-right">{{ __('Enter Category Name:') }}</label>
                    
                        <div class="col-md-6">
                            <input type="text" name="category_name" id="category_name"
                                   class="form-control{{ $errors->has('category_name') ? ' is-invalid' : '' }}"
                                   value="{{ old('category_name') }}">
                            @if ($errors->has('category_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Enter Description:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="description" id="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save New Category</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
