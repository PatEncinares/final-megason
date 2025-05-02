@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/doctor.png') }}" alt="Patient Management">Doctors Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Delete Doctor</li>
        </ol>
            <h3>You are about to delete this record</h3>
        <form method="POST" action="{{ route('delete-doctor-confirm') }}" aria-label="{{ __('Delete Doctor') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data['doctorsDetail']['id'] }}">
            <input type="hidden" name="user_id" value="{{ $data['doctorsAccount']['id'] }}">

            <div class="form-group row">
                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                <div class="col-md-6">
                    <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ $data['doctorsAccount']['name'] }}" required autofocus disabled>

                    @if ($errors->has('fullname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fullname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                <div class="col-md-6">
                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ $data['doctorsDetail']['gender'] }}" required autofocus disabled>
                        <option value="" disabled>-- Select gender --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>

                <div class="col-md-6">
                    <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="{{ $data['doctorsDetail']['specialization'] }}" required autofocus disabled>

                    @if ($errors->has('specialization'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specialization') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $data['doctorsDetail']['address'] }}" required autofocus disabled>

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group row">
                <div class="col-lg-6">

                </div>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Confirm Delete</button>
            </div>
        </form>

        {{-- <patients-list :user_data="user_data"></patients-list> --}}
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
