@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/user_management.JPG') }}" alt="Patient Management">Users</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit User</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Edit User
            </div>
            <div class="card-body">
                
                <form method="POST" action="{{ route('update-user') }}" aria-label="{{ __('Update User') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $data['toEdit'][0]->id }}">
                
                    {{-- Name --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>
                        <div class="col-md-6">
                            <input type="text" name="name" id="name"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   value="{{ old('name', $data['toEdit'][0]->name) }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Email --}}
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   value="{{ old('email', $data['toEdit'][0]->email) }}">
                            <small>Note: Please input a valid and active email address.</small>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Contact Number --}}
                    <div class="form-group row">
                        <label for="contact_number" class="col-md-4 col-form-label text-md-right">Contact Number:</label>
                        <div class="col-md-6">
                            <input type="text" name="contact_number" id="contact_number"
                                   class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}"
                                   value="{{ old('contact_number', $data['toEdit'][0]->contact_number) }}">
                            <small>Note: Include country code (e.g. +639123456789)</small>
                            @if ($errors->has('contact_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- User Type --}}
                    <div class="form-group row">
                        <label for="user_type" class="col-md-4 col-form-label text-md-right">User Type:</label>
                        <div class="col-md-6">
                            <select name="user_type" id="user_type"
                                    class="form-control{{ $errors->has('user_type') ? ' is-invalid' : '' }}">
                                <option value="" disabled>-- Select User Type --</option>
                                @foreach($data['types'] as $usertype)
                                    <option value="{{ $usertype->id }}"
                                        {{ old('user_type', $data['toEdit'][0]->type) == $usertype->id ? 'selected' : '' }}>
                                        {{ $usertype->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    {{-- Submit --}}
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update User</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
