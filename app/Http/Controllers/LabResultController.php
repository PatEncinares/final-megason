<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\LabResult;
use App\Procedure;
use App\Attachment;
use Carbon\Carbon;
use App\ActivityLog;


class LabResultController extends Controller
{
    public function getLabResults(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $labResults = LabResult::with('patient','patient.patientDetails','procedure')->get();

        $data = array(
            'permissions' => $permissions,
            'labResults'  => $labResults,
        );

        return view('lab-results.list')->with('data',$data);
    }

    public function viewlabResult(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $labResult = LabResult::where('id','=',$request->id)->with('patient','patient.patientDetails','procedure','attachments')->get();

        $gender = ucfirst(strtolower($labResult[0]->patient->patientDetails[0]['civil_status']));
        $civil_status = ucfirst(strtolower($labResult[0]->patient->patientDetails[0]['gender']));

        


        $data = array(
            'permissions' => $permissions,
            'labResult'   => $labResult,
            'gender' => $gender,
            'civil_status' => $civil_status,
        );

        // dd($data);
        return view('lab-results.view')->with('data',$data);
    }

    public function createLabResult(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $patients = User::where('type','=','3')->get();
        $procedures = Procedure::all();

        $data = array(
            'permissions' => $permissions,
            'patients'    => $patients,
            'procedures'  => $procedures,
        );

        
        return view('lab-results.create')->with('data',$data);
    }

    public function save(Request $request){
        //save lab results
        $labresult = LabResult::create([
            'patient_id'    => $request->patient_id,
            'procedure_id'  => $request->procedure_id,
            'description'   => $request->description,
        ]);

        if($request->hasfile('attachments')){
            // echo "may attachments";
            foreach($request->file('attachments') as $file){
                $extension = $file->extension();
                $name = Carbon::now()->timestamp . '.' . $extension;
                $filepath = '/labresults/' . $name;
                $file->move(public_path() . '/storage/labresults/', $name);  
                // saving to database
                $attachment = Attachment::create([
                    'attachment_filepath' => $filepath,
                    'attachment_ext'      => $extension,
                    'lab_result_id'       => $labresult->id,
                    'attachment_filename' => $name,
                ]);
            }
        }

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created lab result'
        ]);

        Alert::success('', 'Lab Results Saved!');
        return redirect('/lab-result/list');

    }

    public function editLabResult(Request $request){

    }

    public function updateLabResult(Request $request){

    }

    public function deleteLabResult(Request $request){

    }

    public function download(Request $request){
        $attachment = Attachment::where('id','=',$request->id)->get();

  
        $path = public_path().'/storage'.$attachment[0]->attachment_filepath;

        // dd($path);
        if (file_exists($path)) {
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Downloaded a lab result'
            ]);
            return Response::download($path);
        }

        // return (new Response($file, 200));

    }

    public function procedure(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $data = array(
            'permissions'  => $permissions,
            'patient_id'   => $request->patient_id,
            'procedure_id' => $request->procedure_id,
        );

        switch($request->procedure_id){
            case "1" : // fecalysis
                return view('lab-results.procedures.fecalysis')->with('data',$data);
                break;
            case "2" : // hematology
                return view('lab-results.procedures.hematology')->with('data',$data);
                break;
            case "3" : // urinalysis
                return view('lab-results.procedures.urinalysis')->with('data',$data);
                break;                
            case "4" : // x-ray
                return view('lab-results.procedures.xray')->with('data',$data);
                break;
            case "5" : // ultrasound
                return view('lab-results.procedures.ultrasound')->with('data',$data);
                break;
        }
    }

    public function saveFecalysis(Request $request){
        
        $new = LabResult::create([
            'patient_id'        => $request->patient_id,
            'procedure_id'      => $request->procedure_id,
            'color'             => $request->color,
            'character'         => $request->character,
            'reaction'          => $request->reaction,
            'occult_blood'      => $request->occult_blood,
            'ova_or_parasite'   => $request->ova_or_parasite,
            'remarks'           => $request->remarks,
            'concentration_technique' => $request->concentration_technique,
            'others' => $request->others,
            'pus_cells'         => $request->pus_cells,
            'rbc_count'         => $request->rbc_count,
            'macrophage'        => $request->macrophage,
            'fat_globules'      => $request->fat_globules,
            'pathologist'       => $request->pathologist,
            'medical_technologist' => $request->medical_technologist
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Saved a lab result (Fecalysis)'
        ]);

        Alert::success('', 'Lab Results Saved!');
        return redirect('/lab-result/list');

    }

    public function saveHematology(Request $request){
        $new = LabResult::create([
            'patient_id'        => $request->patient_id,
            'procedure_id'      => $request->procedure_id,
            'hemoglobin'        => $request->hemoglobin,
            'neutrophils'       => $request->neutrophils,
            'hematocrit'          => $request->hematocrit,
            'lymphocytes'      => $request->lymphocytes,
            'wbc_count'   => $request->wbc_count,
            'monocytes'           => $request->monocytes,
            'rbc_count' => $request->rbc_count,
            'eosinophils'         => $request->eosinophils,
            'platelet_count'         => $request->platelet_count,
            'stab_cells'        => $request->stab_cells,
            'reticulocyte_count'      => $request->reticulocyte_count,
            'basophils'       => $request->basophils,
            'erythocytes_sedimentation_rate' => $request->erythocytes_sedimentation_rate,
            'abo_grp' => $request->abo_grp,
            'bleeding_time' => $request->bleeding_time,
            'others' => $request->others,
            'rh_type' => $request->rh_type,
            'clotting_time' => $request->clotting_time,
            'remarks' => $request->remarks,
            'medical_technologist' => $request->medical_technologist,
            'pathologist' => $request->pathologist,
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Saved a lab result (Hematology)'
        ]);

        Alert::success('', 'Lab Results Saved!');
        return redirect('/lab-result/list');
    }

    public function saveUrinalysis(Request $request){
        $new = LabResult::create([
            'patient_id'        => $request->patient_id,
            'procedure_id'      => $request->procedure_id,
            'color'        => $request->color,
            'character'       => $request->character,
            'pH'          => $request->pH,
            'specific_gravity'      => $request->specific_gravity,
            'albumin'   => $request->albumin,
            'sugar'           => $request->sugar,
            'blood' => $request->blood,
            'bilirubin'         => $request->bilirubin,
            'ketone'         => $request->ketone,
            'casts'        => $request->casts,
            'crystals'      => $request->crystals,
            'pregnancy_test'       => $request->pregnancy_test,
            'method_used' => $request->method_used,
            'medical_technologist' => $request->medical_technologist,
            'pus_cells' => $request->pus_cells,
            'rbc_count' => $request->rbc_count,
            'e_cells' => $request->e_cells,
            'a_urates' => $request->a_urates,
            'm_threads' => $request->m_threads,
            'others' => $request->others,
            'remarks' => $request->remarks,
            'pathologist' => $request->pathologist,
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Saved a lab result (Urinalysis)'
        ]);

        Alert::success('', 'Lab Results Saved!');
        return redirect('/lab-result/list');
    }

    public function saveXray(Request $request){
        
        $new = LabResult::create([
            'patient_id'        => $request->patient_id,
            'procedure_id'      => $request->procedure_id,
            'chest_pa'          => $request->chest_pa,
            'impression'        => $request->impression,
            'radiologist'       => $request->radiologist,
            
        ]);

        if($request->hasfile('attachments')){
            // echo "may attachments";
            foreach($request->file('attachments') as $file){
                $extension = $file->extension();
                $name = Carbon::now()->timestamp . '.' . $extension;
                $filepath = '/labresults/' . $name;
                $file->move(public_path() . '/storage/labresults/', $name);  
                // saving to database
                $attachment = Attachment::create([
                    'attachment_filepath' => $filepath,
                    'attachment_ext'      => $extension,
                    'lab_result_id'       => $new->id,
                    'attachment_filename' => $name,
                ]);
            }
        }

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Saved a lab result (X-ray)'
        ]);

        Alert::success('', 'Lab Results Saved!');
        return redirect('/lab-result/list');
    }

    public function saveUltrasound(Request $request){
        $new = LabResult::create([
            'patient_id'        => $request->patient_id,
            'procedure_id'      => $request->procedure_id,
            'impression'        => $request->impression,
            'radiologist'       => $request->radiologist,
            
        ]);

        if($request->hasfile('attachments')){
            // echo "may attachments";
            foreach($request->file('attachments') as $file){
                $extension = $file->extension();
                $name = Carbon::now()->timestamp . '.' . $extension;
                $filepath = '/labresults/' . $name;
                $file->move(public_path() . '/storage/labresults/', $name);  
                // saving to database
                $attachment = Attachment::create([
                    'attachment_filepath' => $filepath,
                    'attachment_ext'      => $extension,
                    'lab_result_id'       => $new->id,
                    'attachment_filename' => $name,
                ]);
            }
        }

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Saved a lab result (Ultrasound)'
        ]);

        Alert::success('', 'Lab Results Saved!');
        return redirect('/lab-result/list');
    }
}
