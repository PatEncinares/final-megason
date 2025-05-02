@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/user_management.JPG') }}" alt="Patient Management">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create User</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Create User
            </div>
            <div class="card-body">
                
                <form method="POST" action="{{ route('save-user') }}" aria-label="{{ __('Save User') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                        </div>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
        
                        <div class="col-md-6">
                            <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            <small>Note: Please input a valid and active email address, a temporary password will be sent to the email address.</small>
                            @if ($errors->has('email'))
                                {{-- {{ dd($errors->first('email')) }} --}}
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        
                    </div>

                    <div class="form-group row">
                        <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" id="contact_number" class="form-control{{ $errors->has('contact_number') ? ' is-invalid' : '' }}" name="contact_number" value="{{ old('contact_number') }}" required>
                            <small>Note: (include country code! e.g +639351234567) Please input a valid and active contact number, your OTP will be sent on this number.</small>
                            @if ($errors->has('contact_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('User Type:') }}</label>
        
                        <div class="col-md-6">
                            <select name="user_type" id="" class="form-control" required>
                                <option value="" selected disabled>-- Select User Type --</option>
                                @foreach($data['types'] as $usertype)
                                    <option value="{{ $usertype->id }}">{{ $usertype->name }}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                    


                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save New User</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
