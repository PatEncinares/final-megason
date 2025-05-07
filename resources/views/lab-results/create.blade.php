@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/microscope.JPG') }}" alt="Patient Management">Laboratory</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary d-print-none mb-2">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Create Lab Result
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('lab-result-procedure') }}" aria-label="{{ __('Create Lab Result') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- <div class="form-group row">
                        <label for="patient" class="col-md-4 col-form-label text-md-right">{{ __('Select Patient:') }}</label>
        
                        <div class="col-md-6">
                            <select name="patient_id" id="patient" class="form-control{{ $errors->has('patient') ? ' is-invalid' : '' }} select2" required>
                                <option value="" selected disabled>-- Select patient --</option>
                                @foreach($data['patients'] as $patient)
                                    <option value="{{ $patient['id'] }}">{{ $patient['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

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

                    <div class="form-group row">
                        <label for="procedure" class="col-md-4 col-form-label text-md-right">{{ __('Select Procedure:') }}</label>
        
                        <div class="col-md-6">
                            <select name="procedure_id" id="procedure" class="form-control{{ $errors->has('procedure') ? ' is-invalid' : '' }}" required>
                                <option value="" selected disabled>-- Select procedure --</option>
                                @foreach($data['procedures'] as $procedure)
                                    <option value="{{ $procedure['id'] }}">{{ $procedure['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Enter Description:') }}</label>
        
                        <div class="col-md-6">
                            <textarea name="description" class="form-control" id="editor" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attachments" class="col-md-4 col-form-label text-md-right">{{ __('Attachments:') }}</label>
        
                        <div class="col-md-6">
                            <input type="file" id="attachments" name="attachments[]" class="form-control{{ $errors->has('attachments') ? ' is-invalid' : '' }}" multiple required>
                        </div>

                        @if ($errors->has('attachments'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('attachments') }}</strong>
                            </span>
                        @endif
                    </div> --}}

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Next</button>
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
</script>
@include('layouts.dashboard.footer')
@endsection
