@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/doctor.png') }}" alt="Patient Management">Doctors Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Doctor</li>
        </ol>

        <form method="POST" action="{{ route('update-doctor') }}" aria-label="{{ __('Edit Doctor') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data['doctorsDetail']['id'] }}">
            <input type="hidden" name="user_id" value="{{ $data['doctorsAccount']['id'] }}">

            <div class="form-group row">
                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                <div class="col-md-6">
                    <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ $data['doctorsAccount']['name'] }}" required autofocus>

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
                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                        <option value="" disabled>-- Select gender --</option>
                        <option value="male" {{ $data['doctorsDetail']['gender'] == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $data['doctorsDetail']['gender'] == 'female' ? 'selected' : '' }}>Female</option>
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
                    <input id="specialization" type="text" class="form-control{{ $errors->has('specialization') ? ' is-invalid' : '' }}" name="specialization" value="{{ $data['doctorsDetail']['specialization'] }}" required autofocus>

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
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $data['doctorsDetail']['address'] }}" required autofocus>

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-6">

                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </form>

        {{-- <patients-list :user_data="user_data"></patients-list> --}}
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
