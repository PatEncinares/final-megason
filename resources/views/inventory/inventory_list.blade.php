@extends('layouts.dashboard.main')

@section('content')
    <main>
        <div class="container-fluid" id="app">
            <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px"
                    src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">Inventory</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Inventory List</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Inventory List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <a href="{{ route('create-inventory') }}" class="btn btn-info"><i class="fa fa-plus"></i> New
                                Item</a>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Add Stock</th>
                                    <th>Pull out stock</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Arrival of Items</th>
                                    <th>Expiration Date</th>
                                    <th>Updated By</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data['inventories'])
                                    @foreach ($data['inventories'] as $inventory)
                                        <tr>
                                            <td nowrap>
                                                <a href="{{ route('edit-inventory', $inventory->id) }}"><button
                                                        class="btn btn-info" title="Edit"><i
                                                            class="fa fa-edit"></i></button></a>
                                                <a href="{{ route('delete-inventory', $inventory->id) }}"><button
                                                        class="btn btn-danger" title="Delete"><i
                                                            class="fa fa-trash"></i></button></a>
                                                <a href="{{ route('add-stock', $inventory->id) }}" class="btn btn-info"
                                                    title="Add Stock"><i class="fa fa-plus"></i></a>
                                                <a href="{{ route('pull-out', $inventory->id) }}" class="btn btn-info"
                                                    title="Pull Out"><i class="fa fa-minus"></i></a>
                                            </td>
                                            <td>{{ 'MD' . str_pad($inventory->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $inventory->item_name }}</td>
                                            <td>{{ $inventory->quantity }}</td>
                                            <td>{{ $inventory->add_stock }}</td>
                                            <td>{{ $inventory->pull_out_stock }}</td>
                                            @if ($inventory->category)
                                                <td>{{ $inventory->category->name }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            <td>{{ $inventory->item_description }}</td>
                                            <td>{{ $inventory->item_price }}</td>
                                            <td>{{ \Carbon\Carbon::parse($inventory->arrival_date)->format('M d, Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($inventory->expiration_date)->format('M d, Y') }}
                                            </td>
                                            <td>{{ $inventory->updatedby->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($inventory->updated_at)->format('M d, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($inventory->updated_at)->format('H:m a') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <center>
                                                No Records to Show
                                            </center>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
    @include('layouts.dashboard.footer')
@endsection
