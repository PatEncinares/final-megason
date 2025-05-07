@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">Inventory</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
            <i class="fa fa-arrow-left"></i> Back
        </a>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Inventory</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Edit Inventory
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('update-inventory') }}" aria-label="Update Inventory" enctype="multipart/form-data">
                    @csrf
                
                    <input type="hidden" name="inventory_id" value="{{ $data['inventory'][0]->id }}">
                
                    {{-- Item Name --}}
                    <div class="form-group row">
                        <label for="item_name" class="col-md-4 col-form-label text-md-right">Item Name:</label>
                        <div class="col-md-6">
                            <input type="text" name="item_name" id="item_name"
                                   class="form-control{{ $errors->has('item_name') ? ' is-invalid' : '' }}"
                                   value="{{ old('item_name', $data['inventory'][0]->item_name) }}" >
                            @if ($errors->has('item_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('item_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Category --}}
                    <div class="form-group row">
                        <label for="category_id" class="col-md-4 col-form-label text-md-right">Category:</label>
                        <div class="col-md-6">
                            <select name="category_id" id="category_id"
                                    class="form-control select2{{ $errors->has('category_id') ? ' is-invalid' : '' }}" >
                                <option value="" disabled>-- Select Category --</option>
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (old('category_id', $data['inventory'][0]->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Item Description --}}
                    <div class="form-group row">
                        <label for="item_description" class="col-md-4 col-form-label text-md-right">Item Description:</label>
                        <div class="col-md-6">
                            <input type="text" name="item_description" id="item_description"
                                   class="form-control{{ $errors->has('item_description') ? ' is-invalid' : '' }}"
                                   value="{{ old('item_description', $data['inventory'][0]->item_description) }}" >
                            @if ($errors->has('item_description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('item_description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Item Price --}}
                    <div class="form-group row">
                        <label for="item_price" class="col-md-4 col-form-label text-md-right">Item Price:</label>
                        <div class="col-md-6">
                            <input type="number" step="0.01" name="item_price" id="item_price"
                                   class="form-control{{ $errors->has('item_price') ? ' is-invalid' : '' }}"
                                   value="{{ old('item_price', $data['inventory'][0]->item_price) }}" >
                            @if ($errors->has('item_price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('item_price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Quantity --}}
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">Quantity:</label>
                        <div class="col-md-6">
                            <input type="number" name="quantity" id="quantity"
                                   class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                   value="{{ old('quantity', $data['inventory'][0]->quantity) }}" >
                            @if ($errors->has('quantity'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Arrival Date --}}
                    <div class="form-group row">
                        <label for="arrival_date" class="col-md-4 col-form-label text-md-right">Arrival Date:</label>
                        <div class="col-md-6">
                            <input type="date" name="arrival_date" id="arrival_date"
                                   class="form-control{{ $errors->has('arrival_date') ? ' is-invalid' : '' }}"
                                   value="{{ old('arrival_date', $data['inventory'][0]->arrival_date) }}" >
                            @if ($errors->has('arrival_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('arrival_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Expiration Date --}}
                    <div class="form-group row">
                        <label for="expiration_date" class="col-md-4 col-form-label text-md-right">Expiration Date:</label>
                        <div class="col-md-6">
                            <input type="date" name="expiration_date" id="expiration_date"
                                   class="form-control{{ $errors->has('expiration_date') ? ' is-invalid' : '' }}"
                                   value="{{ old('expiration_date', $data['inventory'][0]->expiration_date) }}" >
                            @if ($errors->has('expiration_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expiration_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Submit --}}
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#category_id').select2({
            placeholder: '-- Select Category --',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@include('layouts.dashboard.footer')
@endsection
