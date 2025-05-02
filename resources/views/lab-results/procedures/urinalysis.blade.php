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
                Create Lab Result - Urinalysis
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-urinalysis') }}" aria-label="{{ __('Create Lab Result') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="patient_id" value="{{ $data['patient_id'] }}">
                    <input type="hidden" name="procedure_id" value="{{ $data['procedure_id'] }}">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                <label for="color">COLOR</label>
                                                <input type="text" id="color" name="color" class="form-control" required>
                                            </th>
                                            <th>
                                                <label for="character">CHARACTER</label>
                                                <input type="text" id="character" name="character" class="form-control" required>
                                            </th>
                                            <th>
                                                <label for="pH">pH</label>
                                                <input type="text" id="pH" name="pH" class="form-control" required>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label for="specific_gravity">SPECIFIC GRAVITY</label>
                                                <input type="text" id="specific_gravity" name="specific_gravity" class="form-control" required>
                                            </th>
                                            <th>
                                                <label for="albumin">ALBUMIN</label>
                                                <input type="text" id="albumin" name="albumin" class="form-control" required>
                                            </th>
                                            <th>
                                                <label for="sugar">SUGAR</label>
                                                <input type="text" id="sugar" name="sugar" class="form-control" required>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <label for="blood">BLOOD</label>
                                                <input type="text" id="blood" name="blood" class="form-control" required>
                                            </th>
                                            <th>
                                                <label for="bilirubin">BILIRUBIN</label>
                                                <input type="text" id="bilirubin" name="bilirubin" class="form-control" required>
                                            </th>
                                            <th>
                                                <label for="ketone">KETONE</label>
                                                <input type="text" id="ketone" name="ketone" class="form-control" required>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="casts"><strong>CASTS:</strong></label>
                                    <textarea name="casts" id="casts" cols="30" rows="8" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="crystals"><strong>CRYSTALS:</strong></label>
                                    <textarea name="crystals" id="crystals" cols="30" rows="7" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pregnancy_test"><strong>PREGNANCY TEST:</strong></label>
                                    <input type="text" name="pregnancy_test" id="pregnancy_test" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="method_used"><strong>METHOD USED:</strong></label>
                                    <input type="text" name="method_used" id="method_used" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="medical_technologist"><strong>MEDICAL TECHNOLOGIST:</strong></label>
                                    <input type="text" name="medical_technologist" id="medical_technologist" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="pus_cells"><strong>PUS CELLS:</strong></label>
                                    <input type="text" name="pus_cells" id="pus_cells" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="rbc_count"><strong>RBC:</strong></label>
                                    <input type="text" name="rbc_count" id="rbc_count" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="e_cells"><strong>E. CELLS:</strong></label>
                                    <input type="text" name="e_cells" id="e_cells" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="a_urates"><strong>A. URATES:</strong></label>
                                    <input type="text" name="a_urates" id="a_urates" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="m_threads"><strong>M. THREADS:</strong></label>
                                    <input type="text" name="m_threads" id="m_threads" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="others"><strong>OTHERS:</strong></label>
                                    <input type="text" name="others" id="others" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="remarks"><strong>REMARKS:</strong></label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pathologist"><strong>PATHOLOGIST:</strong></label>
                                    <input type="text" name="pathologist" id="pathologist" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">  
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save Lab Result</button>
                            </div> 
                        </div>
                    </div>
        
                </form>
            </div>
        </div>

    </div>
</main>
@include('layouts.dashboard.footer')
@endsection
