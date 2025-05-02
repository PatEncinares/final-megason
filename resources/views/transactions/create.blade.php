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
                    
                    <div class="form-group row">
                        <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Patient:') }}</label>
        
                        <div class="col-md-6">
                            <select name="patient_id" id="" class="form-control" required>
                                <option value="" selected disabled>-- Select Patient --</option>
                                @foreach($data['patients'] as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="doctor_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Doctor:') }}</label>
        
                        <div class="col-md-6">
                            <select name="doctor_id" id="" class="form-control" required>
                                <option value="" selected disabled>-- Select Doctor --</option>
                                @foreach($data['doctors'] as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="appointment_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Appointment:') }}</label>
        
                        <div class="col-md-6">
                            <select name="appointment_id" id="" class="form-control" required>
                                <option value="" selected disabled>-- Select Appointment --</option>
                                @foreach($data['appointments'] as $appointment)
                                    <option value="{{ $appointment->id }}">{{ $appointment->date }} - {{ $appointment->patient->name }}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="doctor_fee" class="col-md-4 col-form-label text-md-right">{{ __('Doctor Fee:') }}</label>
        
                        <div class="col-md-6">
                            <input type="number" name="doctor_fee" class="form-control" id="doctor_fee">                           
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="procedures" class="col-md-4 col-form-label text-md-right">{{ __('Procedures:') }}</label>
        
                        <div class="col-md-6">
                            <select name="procedures[]" class="form-control multiselect" id="procedures" multiple>
                                @foreach($data['procedures'] as $procedure)
                                    <option value="{{ $procedure->id }}">{{ $procedure->name . '-' . $procedure->price}}</option>
                                @endforeach
                            </select>
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
@include('layouts.dashboard.footer')
@endsection
