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
                Create Lab Result - Hematology
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('save-hematology') }}" aria-label="{{ __('Create Lab Result') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="patient_id" value="{{ $data['patient_id'] }}">
                    <input type="hidden" name="procedure_id" value="{{ $data['procedure_id'] }}">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <small>*Note: all fields are required, input 0 or N/A for no values.</small>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th><center>EXAMINATION</center></th>
                                            <th><center>RESULT</center></th>
                                            <th><center>REFERENCE VALUE</center></th>
                                            <th><center>DIFF. COUNT</center></th>
                                            <th><center>RESULT</center></th>
                                            <th><center>REF. VAL.</center></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <label for="hemoglobin">HEMOGLOBIN (HGB)</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="hemoglobin" id="hemoglobin" class="form-control" placeholder="HEMOGLOBIN (HGB)" required>
                                                </td>
                                                <td>
                                                    <small>(M) 130 - 180</small> <br>
                                                    <small>(F) 120 - 160 gm/l</small>
                                                </td>
                                                <th>
                                                    <label for="neutrophils">NEUTROPHILS</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="neutrophils" id="neutrophils" class="form-control" placeholder="NEUTROPHILS" required>
                                                </td>
                                                <td>
                                                    <p>0.51 - 0.67</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="hematocrit">HEMATOCRIT (HCT)</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="hematocrit" id="hematocrit" class="form-control" placeholder="HEMATOCRIT (HCT)" required>
                                                </td>
                                                <td>
                                                    <small>(M) 0.40 - 0.54</small> <br>
                                                    <small>(F) 0.37 - 0.47</small>
                                                </td>
                                                <th>
                                                    <label for="lymphocytes">LYMPHOCYTES</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="lymphocytes" id="lymphocytes" class="form-control" placeholder="LYMPHOCYTES" required>
                                                </td>
                                                <td>
                                                    <p>0.21 - 0.35</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="wbc_count">WBC Count</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="wbc_count" id="wbc_count" class="form-control" placeholder="WBC Count" required>
                                                </td>
                                                <td>
                                                    <p>5-10 X 10<sup>9</sup>/L</p>
                                                </td>
                                                <th>
                                                    <label for="monocytes">MONOCYTES</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="monocytes" id="monocytes" class="form-control" placeholder="MONOCYTES" required>
                                                </td>
                                                <td>
                                                    <p>0.02 - 0.08</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="rbc_count">RBC Count</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="rbc_count" id="rbc_count" class="form-control" placeholder="RBC Count" required>
                                                </td>
                                                <td>
                                                    <small>(M) 4.5 - 6.0</small> <br>
                                                    <small>(F) 4.0-5.5 X 10<sup>12</sup>/L</small>
                                                </td>
                                                <th>
                                                    <label for="eosinophils">EOSINOPHILS</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="eosinophils" id="eosinophils" class="form-control" placeholder="EOSINOPHILS" required>
                                                </td>
                                                <td>
                                                    <p>0.01 - 0.04</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="platelet_count">PLATELET Count</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="platelet_count" id="platelet_count" class="form-control" placeholder="PLATELET Count" required>
                                                </td>
                                                <td>
                                                    <p>150-400 X 10<sup>9</sup>/L</p>
                                                </td>
                                                <th>
                                                    <label for="stab_cells">STAB CELLS</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="stab_cells" id="stab_cells" class="form-control" placeholder="STAB CELLS" required>
                                                </td>
                                                <td>
                                                    <p>0.02 - 0.05</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="reticulocyte_count">RETICULOCYTE Count</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="reticulocyte_count" id="reticulocyte_count" class="form-control" placeholder="RETICULOCYTE Count" required>
                                                </td>
                                                <td>
                                                    <p>1-15 X 10<sup>3</sup></p>
                                                </td>
                                                <th>
                                                    <label for="basophils">BASOPHILS</label>
                                                </th>
                                                <td>
                                                    <input step=".01" type="number" name="basophils" id="basophils" class="form-control" placeholder="BASOPHILS" required>
                                                </td>
                                                <td>
                                                    <p>0.0 - 0.01</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="erythocytes_sedimentation_rate">ERYTHOCYTES SEDIMENTATION RATE (ESR)</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="erythocytes_sedimentation_rate" id="erythocytes_sedimentation_rate" class="form-control" placeholder="ERYTHOCYTES SEDIMENTATION RATE (ESR)" required>
                                                </td>
                                                <td>
                                                    <small>(M) 0-15 mm/hr</small> <br>
                                                    <small>(F) 0-20 mm/hr</small>
                                                </td>
                                                <th>
                                                    <label for="abo_grp">ABO GRP.</label>
                                                </th>
                                                <td>
                                                    <input type="text" name="abo_grp" id="abo_grp" class="form-control" placeholder="ABO GRP." required>
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <label for="bleeding_time">BLEEDING TIME (BT)</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="bleeding_time" id="bleeding_time" class="form-control" placeholder="BLEEDING TIME (BT)" required>
                                                </td>
                                                <td>
                                                    <p>2-4 MINS.</p>
                                                </td>
                                                <th colspan="2">
                                                    <label for="others">OTHERS</label>
                                                    <input type="text" name="others" id="others" class="form-control" placeholder="OTHERS" required>
                                                </th>
                                                <th>
                                                    <label for="rh_type">RH Type</label>
                                                    <input type="text" name="rh_type" id="rh_type" class="form-control" placeholder="RH Type" required>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <label for="clotting_time">CLOTTING TIME (CT)</label>
                                                </th>
                                                <td>
                                                    <input type="number" name="clotting_time" id="clotting_time" class="form-control" placeholder="CLOTTING TIME (CT)" required>
                                                </td>
                                                <td>
                                                    <p>2-4 MINS.</p>
                                                </td>
                                                <th colspan="3">
                                                    
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="3" rowspan="2">
                                                    <label for="remarks">REMARKS</label>
                                                    <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control"></textarea>
                                                </th>
                                                <th colspan="3">
                                                    <label for="medical_technologist">MEDICAL TECHNOLOGIST</label>
                                                    <input type="text" name="medical_technologist" class="form-control" id="medical_technologist" placeholder="MEDICAL TECHNOLOGIST">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">
                                                    <label for="pathologist">PATHOLOGIST</label>
                                                    <input type="text" name="pathologist" class="form-control" id="pathologist" placeholder="PATHOLOGIST">
                                                </th>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
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
