@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">Inventory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add Inventory</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Add Inventory
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-inventory') }}" aria-label="{{ __('Create Inventory') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="item_name" class="col-md-4 col-form-label text-md-right">{{ __('Item Name:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="item_name" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category:') }}</label>
        
                        <div class="col-md-6">
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="" disabled selected>-- Select Category --</option>
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="item_description" class="col-md-4 col-form-label text-md-right">{{ __('Item Description:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="item_description" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="item_price" class="col-md-4 col-form-label text-md-right">{{ __('Item Price:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="item_price" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="quantity" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="arrival_date" class="col-md-4 col-form-label text-md-right">{{ __('Arrival Date') }}</label>

                        <div class="col-md-6">
                          <input id="arrival_date" name="arrival_date" class="form-control{{ $errors->has('arrival_date') ? ' is-invalid' : '' }}" type="date" value="{{ old('arrival_date') }}">
                        </div>

                        @if ($errors->has('arrival_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('arrival_date') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group row">
                        <label for="expiration_date" class="col-md-4 col-form-label text-md-right">{{ __('Expiration Date') }}</label>

                        <div class="col-md-6">
                          <input id="expiration_date" name="expiration_date" class="form-control{{ $errors->has('expiration_date') ? ' is-invalid' : '' }}" type="date" value="{{ old('expiration_date') }}">
                        </div>

                        @if ($errors->has('expiration_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expiration_date') }}</strong>
                            </span>
                        @endif

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Item</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
