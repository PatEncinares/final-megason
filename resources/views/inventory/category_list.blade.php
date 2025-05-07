@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/inventory.JPG') }}" alt="Patient Management">Inventory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Category List</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Category List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="form-group">
                        <a href="{{ route('create-category') }}" class="btn btn-info"><i class="fa fa-plus"></i> New Category</a>
                    </div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data['categories'])
                            @foreach($data['categories'] as $category)
                                <tr>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('edit-category', $category->id) }}" class="btn btn-info" title="Edit">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    
                                        <!-- Delete Button + Hidden Form -->
                                        <button class="btn btn-danger" title="Delete" onclick="confirmDelete({{ $category->id }})">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('delete-category', $category->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                    
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
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
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This category will be deleted permanently.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@include('layouts.dashboard.footer')
@endsection
