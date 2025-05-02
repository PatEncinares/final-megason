<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\PatientDetail;
use App\MedicalHistory;
use App\LabResult;
use RealRashid\SweetAlert\Facades\Alert;
use App\ActivityLog;

class PatientController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $patients = $this->getPatients();
        
        $data = array(
            'permissions' => $permissions,
            'patients' => $patients
        );
        // dd(auth()->user()->id);
        // dd($data);
        return view('patient-management.list')->with('data',$data);

    }

    public function getPatients(){
        $id = auth()->user()->id;
        // dd($id);
        if(Auth::user()->type == 2){
            return PatientDetail::with('doctor.doctorDetails','user','appointments.doctor')
            ->whereHas('appointments', function ($query)
            {
                 $query->where('doctor_id','=',auth()->user()->id)
                     ->orderBy('id','desc');
            })
            ->get();
        }
        else if(Auth::user()->type == 3){
            return PatientDetail::where('user_id', Auth::user()->id)->with('doctor.doctorDetails','user')->get();
        }
        else{
            return PatientDetail::with('doctor.doctorDetails','user')->get();
        }
    }

    public function profile(){
        return view('patient-management.profile');
    }

    public function edit(Request $request){
        $patientDetail = PatientDetail::find($request->id);
        $patientAccount = User::find($patientDetail->user_id);

        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $data = array(
            'permissions' => $permissions,
            'patientDetail' => $patientDetail,
            'patientAccount' => $patientAccount,
        );

        return view('patient-management.edit')->with('data',$data);
        
    }

    public function update(Request $request){
        $validated = $request->validate([
            'fullname' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'mobile' => ['required', 'regex:/^\+63\d{10}$/'],
            'gender' => ['required', 'in:male,female'],
            'civil_status' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'address' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'emergency_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'emergency_address' => ['required', 'string'],
            'emergency_number' => ['required', 'regex:/^\+63\d{10}$/'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
        ], [
            'fullname.required' => 'Full name is required.',
            'fullname.regex' => 'Full name must only contain letters and spaces.',
            
            'mobile.required' => 'Mobile number is required.',
            'mobile.regex' => 'Mobile number must start with +63 followed by 10 digits.',
        
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Gender must be either male or female.',
        
            'civil_status.required' => 'Civil status is required.',
        
            'age.required' => 'Age is required.',
            'age.integer' => 'Age must be a number.',
        
            'address.required' => 'Address is required.',
        
            'dob.required' => 'Date of birth is required.',
            'dob.date' => 'Date of birth must be a valid date.',
        
            'emergency_name.required' => 'Emergency contact name is required.',
            'emergency_name.regex' => 'Emergency contact name must only contain letters and spaces.',
        
            'emergency_address.required' => 'Emergency contact address is required.',
        
            'emergency_number.required' => 'Emergency contact number is required.',
            'emergency_number.regex' => 'Emergency number must start with +63 followed by 10 digits.',
        
            'weight.required' => 'Weight is required.',
            'weight.numeric' => 'Weight must be a number (e.g., 64.5).',
        
            'height.required' => 'Height is required.',
            'height.numeric' => 'Height must be a number (e.g., 170.2).',
        ]);
    
        $patientDetail = PatientDetail::find($request->id);
        $patientAccount = User::find($request->user_id);
    
        $patientAccount->name = $validated['fullname'];
        $patientAccount->save();
    
        $patientDetail->mobile_number = $validated['mobile'];
        $patientDetail->gender        = $validated['gender'];
        $patientDetail->civil_status  = $validated['civil_status'];
        $patientDetail->age           = $validated['age'];
        $patientDetail->address       = $validated['address'];
        $patientDetail->date_of_birth = $validated['dob'];
        $patientDetail->emergency_name= $validated['emergency_name'];
        $patientDetail->emergency_address = $validated['emergency_address'];
        $patientDetail->emergency_number = $validated['emergency_number'];
        $patientDetail->weight = $validated['weight'];
        $patientDetail->height = $validated['height'];
        $patientDetail->save();
    
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Updated patient details'
        ]);
    
        Alert::success('', 'Patient Details Updated!');
    
        return back();
    }

    public function view(Request $request){
        $patientDetail = PatientDetail::find($request->id);
        $patientAccount = User::find($patientDetail->user_id);
        $medicalHistory = MedicalHistory::where('patient_id','=',$patientDetail->user_id)->with('doctor')->get();
        $labResults = LabResult::where('patient_id','=', $patientDetail->user_id)->with('patient','patient.patientDetails','procedure')->get();

        $resultLab = [];
        foreach ($labResults as $lab) {
            $lab->isViewPatientMedicalHistory = true;
            array_push($resultLab, $lab);
        }

        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();

        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $data = array(
            'permissions' => $permissions,
            'patientDetail' => $patientDetail,
            'patientAccount' => $patientAccount,
            'medicalHistory' => $medicalHistory,
            'labResults' => $resultLab,
            'isViewPatientMedicalHistory' => true,
        );

        return view('patient-management.view')->with('data',$data);
    }

    public function delete(Request $request){
        $patientDetail = PatientDetail::find($request->id);
        $patientAccount = User::find($patientDetail->user_id)->delete();
        PatientDetail::find($request->id)->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Delete patient details'
        ]);

        Alert::success('', 'Patient Details Deleted!');

        return back();

    }

    public function createMedicalHistory(Request $request){
        $patientDetail = PatientDetail::find($request->id);
        $patientAccount = User::find($patientDetail->user_id);
        $doctors = User::where('type','=',2)->get();
        
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $lockedDoctorId = null;
        if(Auth::user()->type == 2) {
            $lockedDoctorId = Auth::user()->id;
        }

        $data = array(
            'permissions' => $permissions,
            'patientDetail' => $patientDetail,
            'doctors'       => $doctors,
            'patientAccount' => $patientAccount,
            'lockedDoctorId' => $lockedDoctorId,
        );

        return view('patient-management.create_medical_history')->with('data',$data);
    }

    public function saveMedicalHistory(Request $request){
        $patientAccount = User::where('id','=',$request->patient_id)->with('patientDetails')->get();
        
        $newRecord = MedicalHistory::create([
            'patient_id' => $request->patient_id,
            'complains'  => $request->complains,
            'diagnosis'  => $request->diagnosis,
            'treatment'  => $request->treatment,
            'last_visit' => $request->last_visit,
            'next_visit' => $request->next_visit,
            'attending_doctor' => $request->attending_doctor
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created a patient medical history'
        ]);

        Alert::success('', 'Successfuly saved medical history');
        return redirect()->route('view-patient', $patientAccount[0]['patientDetails'][0]['id']);
        
    }
}
