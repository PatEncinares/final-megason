@extends('layouts.dashboard.main')

@section('content')
<main>
    <div class="container-fluid" id="app">
        <h1 class="mt-4"><img class="card-img-top img-thumbnail" style="height: 60px; width : 60px" src="{{ asset('assets/quick_links/microscope.JPG') }}" alt="Patient Management">Laboratory</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Create Lab Result - X-Ray
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-xray') }}" aria-label="{{ __('Create Lab Result') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="patient_id" value="{{ $data['patient_id'] }}">
                    <input type="hidden" name="procedure_id" value="{{ $data['procedure_id'] }}">
                    <div class="form-group row">
                        <label for="chest_pa" class="col-md-4 col-form-label text-md-right">{{ __('CHEST PA:') }}</label>
        
                        <div class="col-md-6">
                            <textarea name="chest_pa" class="form-control" id="chest_pa" cols="30" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="impression" class="col-md-4 col-form-label text-md-right">{{ __('IMPRESSION:') }}</label>
        
                        <div class="col-md-6">
                            <textarea name="impression" class="form-control" id="impression" cols="30" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="radiologist" class="col-md-4 col-form-label text-md-right">{{ __('RADIOLOGIST/SONOLOGIST:') }}</label>
        
                        <div class="col-md-6">
                            <input type="text" name="radiologist" class="form-control" id="radiologist" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="attachments" class="col-md-4 col-form-label text-md-right">{{ __('Attachments (OPTIONAL):') }}</label>
        
                        <div class="col-md-6">
                            <input type="file" id="attachments" name="attachments[]" class="form-control{{ $errors->has('attachments') ? ' is-invalid' : '' }}" multiple>
                        </div>

                        @if ($errors->has('attachments'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('attachments') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Lab Result</button>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
