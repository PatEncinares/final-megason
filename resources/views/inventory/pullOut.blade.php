@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">Inventory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pull-out Stock</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Pull-out Stock
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-pull-out') }}" aria-label="{{ __('Pull-out Stock') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <h5>Pulling out stock for {{ $data['inventory'][0]->item_name }}</h5>
                        </div>
                    </div>
                    <input type="hidden" name="inventory_id" value="{{ $data['inventory'][0]->id }}">
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity:') }}</label>
        
                        <div class="col-md-6">
                            <input type="number" name="quantity" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Pull Out Stock</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
