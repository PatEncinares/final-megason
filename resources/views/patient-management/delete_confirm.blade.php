@extends('layouts.dashboard.main')

@section('content')

<?php var_dump($data) ?>
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4">Patient Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Patient</li>
        </ol>

        <form method="POST" action="{{ route('update-patient') }}" aria-label="{{ __('Edit Patient') }}">
            @csrf
            <h3>Personal Information</h3>
            <input type="hidden" name="id" value="{{ $data['patientDetail']['id'] }}">
            <input type="hidden" name="user_id" value="{{ $data['patientAccount']['id'] }}">

            <div class="form-group row">
                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                <div class="col-md-6">
                    <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ $data['patientAccount']['name'] }}" required autofocus>

                    @if ($errors->has('fullname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fullname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                <div class="col-md-6">
                    <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $data['patientDetail']['mobile_number'] }}" required autofocus>

                    @if ($errors->has('mobile'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                <div class="col-md-6">
                  <input id="dob" name="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" type="date" value="{{ date('Y-m-d',strtotime($data['patientDetail']['date_of_birth'])) }}">
                </div>

                @if ($errors->has('dob'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                <div class="col-md-6">
                    <select name="gender" id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ $data['patientDetail']['gender'] }}" required autofocus>
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
                <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                <div class="col-md-6">
                    <input id="age" type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ $data['patientDetail']['age'] }}" required autofocus>

                    @if ($errors->has('age'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('age') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $data['patientDetail']['address'] }}" required autofocus>

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (kg)') }}</label>

                <div class="col-md-6">
                    <input id="weight" type="number" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{ $data['patientDetail']['weight'] }}" required autofocus>

                    @if ($errors->has('weight'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('weight') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height (cm)') }}</label>

                <div class="col-md-6">
                    <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="{{ $data['patientDetail']['height'] }}" required autofocus>

                    @if ($errors->has('height'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('height') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <hr>

            <h3>Emergency Contact</h3>

            <div class="form-group row">
                <label for="emergency_name" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Name') }}</label>

                <div class="col-md-6">
                    <input id="emergency_name" type="text" class="form-control{{ $errors->has('emergency_name') ? ' is-invalid' : '' }}" name="emergency_name" value="{{ $data['patientDetail']['emergency_name'] }}" required autofocus>

                    @if ($errors->has('emergency_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('emergency_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="emergency_number" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Number') }}</label>

                <div class="col-md-6">
                    <input id="emergency_number" type="text" class="form-control{{ $errors->has('emergency_number') ? ' is-invalid' : '' }}" name="emergency_number" value="{{ $data['patientDetail']['emergency_number'] }}" required autofocus>

                    @if ($errors->has('emergency_number'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('emergency_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="emergency_address" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Contact Address') }}</label>

                <div class="col-md-6">
                    <input id="emergency_address" type="text" class="form-control{{ $errors->has('emergency_address') ? ' is-invalid' : '' }}" name="emergency_address" value="{{ $data['patientDetail']['emergency_address'] }}" required autofocus>

                    @if ($errors->has('emergency_address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('emergency_address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </form>

        {{-- <patients-list :user_data="user_data"></patients-list> --}}
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
