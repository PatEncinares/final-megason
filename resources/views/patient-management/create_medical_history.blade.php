@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/patient.png') }}" alt="Patient Management">Patient Management</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create Medical History</li>
        </ol>

        <form method="POST" action="{{ route('save-medical-history') }}" aria-label="{{ __('Create Medical History') }}">
            @csrf            
            <input type="hidden" name="patient_id" value="{{ $data['patientAccount']['id'] }}">

            <div class="form-group row">
                <label for="complains" class="col-md-4 col-form-label text-md-right">{{ __('Complains') }}</label>

                <div class="col-md-6">
                    <small>*Note: Provide a detailed explanation of patient complains and symptoms</small>
                    <textarea name="complains" class="form-control" id="" cols="15" rows="5" required></textarea>
                    
                    @if ($errors->has('complains'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('complains') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="diagnosis" class="col-md-4 col-form-label text-md-right">{{ __('Diagnosis') }}</label>

                <div class="col-md-6">
                    <small>*Note: Provide a detailed diagnosis and findings</small>
                    <textarea name="diagnosis" class="form-control" id="" cols="15" rows="5" required></textarea>
                    
                    @if ($errors->has('diagnosis'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('diagnosis') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="treatment" class="col-md-4 col-form-label text-md-right">{{ __('Treatment') }}</label>

                <div class="col-md-6">
                    <small>*Note: Provide a detailed treatment procedures, schedule of medication etc.</small>
                    <textarea name="treatment" class="form-control" id="" cols="15" rows="5" required></textarea>
                    
                    @if ($errors->has('treatment'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('treatment') }}</strong>
                        </span>
                    @endif
                </div>

            </div>

            <div class="form-group row">
                <label for="last_visit" class="col-md-4 col-form-label text-md-right">{{ __('Date of last Visit') }}</label>

                <div class="col-md-6">
                  <input id="last_visit" name="last_visit" class="form-control{{ $errors->has('last_visit') ? ' is-invalid' : '' }}" type="date" value="{{ date('Y-m-d',strtotime($data['patientDetail']['date_of_birth'])) }}" required>
                </div>

                @if ($errors->has('last_visit'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last_visit') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group row">
                <label for="next_visit" class="col-md-4 col-form-label text-md-right">{{ __('Date of Next Visit') }}</label>

                <div class="col-md-6">
                  <input id="next_visit" name="next_visit" class="form-control{{ $errors->has('next_visit') ? ' is-invalid' : '' }}" type="date" value="{{ date('Y-m-d',strtotime($data['patientDetail']['date_of_birth'])) }}" required>
                </div>

                @if ($errors->has('next_visit'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('next_visit') }}</strong>
                    </span>
                @endif

            </div>
            <hr>

            
            {{-- <div class="form-group row">
                <label for="attending_doctor" class="col-md-4 col-form-label text-md-right">{{ __('Attending Doctor') }}</label>

                <div class="col-md-6">
                    <select name="attending_doctor" class="form-control" id="">
                        <option value="" selected disabled>-- Select Doctor --</option>
                        @foreach ($data['doctors'] as $doctor)
                            <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div> --}}

            <div class="form-group row">
                <label for="attending_doctor" class="col-md-4 col-form-label text-md-right">{{ __('Attending Doctor') }}</label>
            
                <div class="col-md-6">
                    @if(!empty($data['lockedDoctorId']))
                        <!-- Lock the attending doctor when a doctor is logged in -->
                        <input type="hidden" name="attending_doctor" value="{{ $data['lockedDoctorId'] }}">
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    @else
                        <select name="attending_doctor" class="form-control">
                            <option value="" selected disabled>-- Select Doctor --</option>
                            @foreach ($data['doctors'] as $doctor)
                                <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Medical History</button>
                </div>
            </div>
        </form>

        {{-- <patients-list :user_data="user_data"></patients-list> --}}
    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
