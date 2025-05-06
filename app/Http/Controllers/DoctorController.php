<?php

namespace App\Http\Controllers;
use App\User;
use App\ActivityLog;
use App\DoctorDetail;
use App\DoctorSchedule;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $doctors = $this->getDoctors();

        $data = array(
            'permissions' => $permissions,
            'doctors' => $doctors
        );

        
        // dd($data);
        return view('doctors-management.list')->with('data',$data);

    }

    public function getDoctors(){
        if(Auth::user()->type == 2){
            return DoctorDetail::where('user_id',Auth::user()->id)->get();
        }else{
            return DoctorDetail::all();
        }
    }

    // public function edit(Request $request){
    //     $doctorsDetail = DoctorDetail::find($request->id);
    //     $doctorsAccount = User::find($doctorsDetail->user_id);

    //     $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
    //     $permissions = [];
    //     foreach($user[0]->usertype->permissions as $permission)
    //     {
    //         array_push($permissions, $permission->name);
    //     }
    //     $data = array(
    //         'permissions' => $permissions,
    //         'doctorsDetail' => $doctorsDetail,
    //         'doctorsAccount' => $doctorsAccount
    //     );

    //     return view('doctors-management.edit')->with('data',$data);
    // }
    public function edit(Request $request)
    {
        $doctorsDetail = DoctorDetail::with('schedules')->find($request->id); // ✅ eager load schedules
        $doctorsAccount = User::find($doctorsDetail->user_id);

        $user = User::where('id', Auth::user()->id)->with('usertype', 'usertype.permissions')->get();
        $permissions = [];
        foreach ($user[0]->usertype->permissions as $permission) {
            $permissions[] = $permission->name;
        }

        $data = [
            'permissions' => $permissions,
            'doctorsDetail' => $doctorsDetail,
            'doctorsAccount' => $doctorsAccount
        ];

        return view('doctors-management.edit')->with('data', $data);
    }

    public function update(Request $request)
    {
        $doctorsDetail = DoctorDetail::find($request->id);
        $doctorsAccount = User::find($request->user_id);
    
        // Update doctor user info
        $doctorsAccount->name = $request->fullname;
        $doctorsAccount->save();
    
        // Update doctor profile
        $doctorsDetail->fullname = $request->fullname;
        $doctorsDetail->gender = $request->gender;
        $doctorsDetail->specialization = $request->specialization;
        $doctorsDetail->address = $request->address;
        $doctorsDetail->save();
    
        // Delete existing schedules for this user ID (not doctor_details.id)
        DoctorSchedule::where('doctor_id', $doctorsAccount->id)->delete();
    
        // Create new schedules
        if ($request->has('schedules')) {
            foreach ($request->schedules as $day => $info) {
                if (isset($info['enabled'])) {
                    DoctorSchedule::create([
                        'doctor_id'    => $doctorsAccount->id, // ✅ this is users.id
                        'day_of_week'  => $day,
                        'start_time'   => $info['start_time'],
                        'end_time'     => $info['end_time'],
                        'max_patients' => $info['max_patients'],
                    ]);
                }
            }
        }
    
        ActivityLog::create([
            'user_id'  => Auth::user()->id,
            'activity' => 'Updated a doctor details'
        ]);
    
        Alert::success('', 'Doctor Details Updated!');
        return back();
    }
    

    public function delete(Request $request){
        $doctorsDetail = DoctorDetail::find($request->id);
        $doctorsAccount = User::find($doctorsDetail->user_id);

        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $data = array(
            'permissions' => $permissions,
            'doctorsDetail' => $doctorsDetail,
            'doctorsAccount' => $doctorsAccount
        );

        return view('doctors-management.delete_confirm')->with('data',$data);
    }

    public function deleteDoctor(Request $request){
        $user = User::find($request->user_id);
        $doctorsDetail = DoctorDetail::find($request->id);

        $user->delete();
        $doctorsDetail->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Deleted a doctor account'
        ]);

        Alert::success('', 'Doctor has been deleted!');

        return redirect('/doctors-list');
    }

    public function getSchedule($id)
{
    $schedules = \App\DoctorSchedule::where('doctor_id', $id)->get();

    return response()->json($schedules);
}
}
