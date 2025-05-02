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
                Create Lab Result - Fecalysis
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-fecalysis') }}" aria-label="{{ __('Create Lab Result') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="patient_id" value="{{ $data['patient_id'] }}">
                    <input type="hidden" name="procedure_id" value="{{ $data['procedure_id'] }}">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5><u>MICROSCOPIC</u></h5>
                                <div class="form-group row">
                                    <label for="color" class="col-md-4 col-form-label ">{{ __('COLOR:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="color" id="color" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="character" class="col-md-4 col-form-label ">{{ __('CHARACTER:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="character" id="color" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reaction" class="col-md-4 col-form-label ">{{ __('REACTION:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="reaction" id="reaction" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="occult_blood" class="col-md-4 col-form-label ">{{ __('OCCULT BLOOD:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="occult_blood" id="occult_blood" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ova_or_parasite" class="col-md-4 col-form-label ">{{ __('OVA OR PARASITE:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="ova_or_parasite" id="ova_or_parasite" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                
                                <div class="form-group row">
                                    <label for="remarks" class="col-md-4 col-form-label ">{{ __('REMARKS:') }}</label>
                    
                                    <div class="col-md-6">
                                        <textarea name="remarks" class="form-control" id="" cols="30" rows="10" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5><u>CONCENTRATION TECHNIQUE</u></h5>
                                <div class="form-group row">
                                    {{-- <label for="color" class="col-md-4 col-form-label ">{{ __('Select Patient:') }}</label> --}}
                                    <div class="col-md-12">
                                        <textarea name="concentration_technique" class="form-control" id="" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <h6>OTHERS, SPECIFY:</h6>
                                <div class="form-group row">
                                    {{-- <label for="color" class="col-md-4 col-form-label ">{{ __('Others, specify:') }}</label> --}}
                                    <div class="col-md-12">
                                        <textarea name="others" class="form-control" id="" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <div class="form-group row">
                                    <label for="pus_cells" class="col-md-4 col-form-label ">{{ __('PUS CELLS:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="pus_cells" id="pus_cells" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <p>/hpf</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rbc_count" class="col-md-4 col-form-label ">{{ __('RBC:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="rbc_count" id="rbc_count" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <p>/hpf</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="macrophage" class="col-md-4 col-form-label">{{ __('MACROPHAGE:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="macrophage" id="macrophage" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <p>/hpf</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fat_globules" class="col-md-4 col-form-label">{{ __('FAT GLOBULES:') }}</label>
                    
                                    <div class="col-md-6">
                                        <input type="text" name="fat_globules" id="fat_globules" class="form-control" required>
                                    </div>
                                    <div class="col-md-2">
                                        <p>/hpf</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-sm-6" style="border-right : 0.5px solid #CED4DA">
                                        <div class="form-group row">
                                            <label for="pathologist" class="col-form-label">{{ __('PATHOLOGIST:') }}</label>
                            
                                            <div class="col-md-12">
                                                <input type="text" name="pathologist" id="pathologist" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group row" style="padding-left: 3px;">
                                            <label for="medical_technologist" class="col-form-label">{{ __('MEDICAL TECHNOLOGIST:') }}</label>
                            
                                            <div class="col-md-12">
                                                <input type="text" name="medical_technologist" id="medical_technologist" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">    
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save Lab Result</button>
                        </div>
                        
                    </div>

                    
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
