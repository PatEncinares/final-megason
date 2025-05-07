@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/transaction.JPG') }}" alt="Patient Management">Transactions</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create Transaction</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Create Transaction
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-transaction') }}" aria-label="{{ __('Save Transaction') }}" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Patient --}}
                    <div class="form-group row">
                        <label for="patient_id" class="col-md-4 col-form-label text-md-right">Select Patient:</label>
                        <div class="col-md-6">
                            <select name="patient_id" id="patient_id" class="form-control select2" required>
                                <option value="" disabled selected>-- Select Patient --</option>
                                @foreach($data['patients'] as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('patient_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('patient_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Doctor --}}
                    <div class="form-group row">
                        <label for="doctor_id" class="col-md-4 col-form-label text-md-right">Select Doctor:</label>
                        <div class="col-md-6">
                            <select name="doctor_id" id="doctor_id" class="form-control select2" required>
                                <option value="" disabled selected>-- Select Doctor --</option>
                                @foreach($data['doctors'] as $doctor)
                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('doctor_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('doctor_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Appointment --}}
                    <div class="form-group row">
                        <label for="appointment_id" class="col-md-4 col-form-label text-md-right">Select Appointment:</label>
                        <div class="col-md-6">
                            <select name="appointment_id" id="appointment_id" class="form-control select2" required>
                                <option value="" disabled selected>-- Select Appointment --</option>
                                @foreach($data['appointments'] as $appointment)
                                    <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                        {{ $appointment->date }} - {{ $appointment->patient->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('appointment_id'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('appointment_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Doctor Fee --}}
                    <div class="form-group row">
                        <label for="doctor_fee" class="col-md-4 col-form-label text-md-right">Doctor Fee:</label>
                        <div class="col-md-6">
                            <input type="number" name="doctor_fee" class="form-control" id="doctor_fee" value="{{ old('doctor_fee') }}">
                            @if ($errors->has('doctor_fee'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('doctor_fee') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Procedures --}}
                    <div class="form-group row">
                        <label for="procedures" class="col-md-4 col-form-label text-md-right">Procedures:</label>
                        <div class="col-md-6">
                            <select name="procedures[]" class="form-control multiselect" id="procedures" multiple>
                                @foreach($data['procedures'] as $procedure)
                                    <option value="{{ $procedure->id }}" {{ collect(old('procedures'))->contains($procedure->id) ? 'selected' : '' }}>
                                        {{ $procedure->name . '-' . $procedure->price }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('procedures'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('procedures') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-5 col-form-label text-md-right">
                            <input class="form-check-input" name="discount" type="checkbox" value="20" id="discount">
                            <label class="form-check-label" for="discount">
                                {{ __('Senior/PWD Discount:') }}
                            </label>
                        </div>
                       
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save New Transaction</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
            $('#patient_id').select2({
                placeholder: '-- Select Patient --',
                allowClear: true,
                width: '100%'
            });
        });

document.addEventListener('DOMContentLoaded', function () {
    $('#doctor_id').select2({
        placeholder: '-- Select Doctor --',
        allowClear: true,
        width: '100%'
    });
});

document.addEventListener('DOMContentLoaded', function () {
    $('#appointment_id').select2({
        placeholder: '-- Select Appointment --',
        allowClear: true,
        width: '100%'
    });
});
</script>
@include('layouts.dashboard.footer')
@endsection
