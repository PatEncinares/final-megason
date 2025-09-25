<?php

namespace App\Http\Controllers;
use App\User;
use App\ActivityLog;
use App\DoctorDetail;
use App\DoctorSchedule;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



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

    public function getDoctors()
    {
        if (Auth::user()->type == 2) {
            return DoctorDetail::with('specialization')->where('user_id', Auth::user()->id)
            ->select('id', 'user_id', 'specialization_id', 'fullname', 'gender', 'address', 'created_at', 'updated_at')
            ->get();
        } else {
            return DoctorDetail::with('specialization')->select('id', 'user_id', 'specialization_id', 'fullname', 'gender', 'address', 'created_at', 'updated_at')->get();
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
        $doctorsDetail = DoctorDetail::with(['schedules', 'specialization'])->find($request->id); // ✅ eager load schedules
        $doctorsAccount = User::find($doctorsDetail->user_id);
        $specialization = Specialization::all();

        $user = User::where('id', Auth::user()->id)->with('usertype', 'usertype.permissions')->get();
        $permissions = [];
        foreach ($user[0]->usertype->permissions as $permission) {
            $permissions[] = $permission->name;
        }

        $data = [
            'permissions' => $permissions,
            'doctorsDetail' => $doctorsDetail,
            'doctorsAccount' => $doctorsAccount,
            'specialization' => $specialization
        ];  

        return view('doctors-management.edit')->with('data', $data);
    }

    // public function update(Request $request)
    // {
    //     // $request->merge([
    //     //     'fullname' => preg_replace('/^(Dr\.?|Dra\.?)\s*/i', '', $request->fullname)
    //     // ]);
    //     $request->merge([
    //         'fullname' => preg_replace('/\s{2,}/', ' ', preg_replace('/^(?:Dra\.?|Dr\.?)\s*/i', '', trim($request->fullname))),
    //     ]);

    //     $request->validate([
    //         'fullname' => [
    //             'required',
    //             'regex:/^[a-zA-Z\s]+$/',
    //             'max:255'
    //         ],
    //         'gender' => 'required|in:male,female',
    //         'specialization_id' => 'required|exists:specializations,id',
    //         'address' => [
    //             'required',
    //             'regex:/^[a-zA-Z0-9\s,.-]+$/',
    //             'max:255'
    //         ],
    //     ], [
    //         'fullname.regex' => 'Full name should not contain numbers, symbols, or special characters.',
    //         'fullname.required' => 'Full name is required.',
    //         'gender.required' => 'Gender is required.',
    //         'gender.in' => 'Gender must be either male or female.',
    //         'specialization_id.required' => 'Specialization is required.',
    //         'specialization_id.exists' => 'Selected specialization is invalid.',
    //         'address.required' => 'Address is required.',
    //         'address.regex' => 'Address contains invalid characters.',
    //     ]);

    //     $doctorsDetail = DoctorDetail::find($request->id);
    //     $doctorsAccount = User::find($request->user_id);
    
    //     // Update doctor user info
    //     $doctorsAccount->name = $request->fullname;
    //     $doctorsAccount->save();
    
    //     // Update doctor profile
    //     $doctorsDetail->fullname = $request->fullname;
    //     $doctorsDetail->gender = $request->gender;
    //     $doctorsDetail->specialization_id = $request->specialization_id;
    //     $doctorsDetail->address = $request->address;
    //     $doctorsDetail->save();
    
    //     // Delete existing schedules for this user ID (not doctor_details.id)
    //     DoctorSchedule::where('doctor_id', $doctorsAccount->id)->delete();
    
    //     // Create new schedules
    //     if ($request->has('schedules')) {
    //         foreach ($request->schedules as $day => $info) {
    //             if (isset($info['enabled'])) {
    //                 DoctorSchedule::create([
    //                     'doctor_id'    => $doctorsAccount->id, // ✅ this is users.id
    //                     'day_of_week'  => $day,
    //                     'start_time'   => $info['start_time'],
    //                     'end_time'     => $info['end_time'],
    //                     'max_patients' => $info['max_patients'],
    //                 ]);
    //             }
    //         }
    //     }
    
    //     ActivityLog::create([
    //         'user_id'  => Auth::user()->id,
    //         'activity' => 'Updated a doctor details'
    //     ]);
    
    //     Alert::success('', 'Doctor Details Updated!');
    //     return back();
    // }

    public function update(Request $request)
{
    // Normalize fullname (strip Dr./Dra., collapse spaces)
    $request->merge([
        'fullname' => preg_replace('/\s{2,}/', ' ', preg_replace('/^(?:Dra\.?|Dr\.?)\s*/i', '', trim($request->fullname))),
    ]);

    // Allowed sets for strict validation
    $startSet = ['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00']; // 9–4 PM start
    $endSet   = ['10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00']; // 10–5 PM end

    $rules = [
        'fullname' => ['required','regex:/^[A-Za-z\s]+$/','max:255'],
        'gender' => 'required|in:male,female',
        'specialization_id' => 'required|exists:specializations,id',
        'address' => ['required','regex:/^[A-Za-z0-9\s,.\-]+$/','max:255'],

        'schedules' => 'array',
        'schedules.*.enabled' => 'nullable|boolean',

        // Required when enabled; restrict to allowed sets
        'schedules.*.start_time'   => ['nullable','required_with:schedules.*.enabled', 'in:'.implode(',', $startSet)],
        'schedules.*.end_time'     => ['nullable','required_with:schedules.*.enabled', 'in:'.implode(',', $endSet), 'not_in:09:00'],
        'schedules.*.max_patients' => ['nullable','required_with:schedules.*.enabled', 'integer','min:1','max:100'],
    ];

    $messages = [
        'fullname.regex' => 'Full name should not contain numbers, symbols, or special characters.',
        'schedules.*.start_time.in' => 'Start time must be between 9:00 AM and 4:00 PM.',
        'schedules.*.end_time.in'   => 'End time must be between 10:00 AM and 5:00 PM.',
        'schedules.*.end_time.not_in' => 'End time cannot be 9:00 AM.',
        'schedules.*.max_patients.required_with' => 'Max patients is required when a day is enabled.',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    // Custom duration rule: End must be 1–2 hours after Start (inclusive)
    $validator->after(function ($v) use ($request) {
        if (!$request->has('schedules')) return;
        foreach ($request->input('schedules') as $day => $info) {
            if (empty($info['enabled'])) continue;

            $start = $info['start_time'] ?? null;
            $end   = $info['end_time'] ?? null;

            if (!$start || !$end) continue;

            // Convert HH:MM to minutes
            [$sh, $sm] = array_map('intval', explode(':', $start));
            [$eh, $em] = array_map('intval', explode(':', $end));
            $startMin = $sh * 60 + $sm;
            $endMin   = $eh * 60 + $em;

            if ($endMin <= $startMin) {
                $v->errors()->add("schedules.$day.end_time", 'End time must be after start time.');
                continue;
            }

            $diff = $endMin - $startMin;
            if ($diff < 60 || $diff > 120) {
                $v->errors()->add("schedules.$day.end_time", 'Duration must be between 1 and 2 hours.');
            }
        }
    });

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $doctorsDetail  = DoctorDetail::findOrFail($request->id);
    $doctorsAccount = User::findOrFail($request->user_id);

    // Update doctor user info
    $doctorsAccount->name = $request->fullname;
    $doctorsAccount->save();

    // Update doctor profile
    $doctorsDetail->fullname          = $request->fullname;
    $doctorsDetail->gender            = $request->gender;
    $doctorsDetail->specialization_id = $request->specialization_id;
    $doctorsDetail->address           = $request->address;
    $doctorsDetail->save();

    // Replace schedules for this user
    DoctorSchedule::where('doctor_id', $doctorsAccount->id)->delete();

    if ($request->has('schedules')) {
        foreach ($request->schedules as $day => $info) {
            if (!empty($info['enabled'])) {
                DoctorSchedule::create([
                    'doctor_id'    => $doctorsAccount->id,
                    'day_of_week'  => $day,
                    'start_time'   => $info['start_time'], // already HH:MM
                    'end_time'     => $info['end_time'],   // already HH:MM
                    'max_patients' => (int)$info['max_patients'],
                ]);
            }
        }
    }

    ActivityLog::create([
        'user_id'  => Auth::id(),
        'activity' => 'Updated a doctor details',
    ]);

    Alert::success('', 'Doctor Details Updated!');
    return back();
}
    

    public function delete(Request $request)
    {
        $doctorDetail = DoctorDetail::find($request->id);
    
        if ($doctorDetail) {
            $doctorAccount = User::find($doctorDetail->user_id);
    
            // Delete doctor account if it exists
            if ($doctorAccount) {
                $doctorAccount->delete();
            }
    
            // Delete doctor detail
            $doctorDetail->delete();
        }
    
        return redirect()->route('doctors-list')->with('success', 'Doctor deleted successfully.');
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
        $schedules = DoctorSchedule::where('doctor_id', $id)->get();

        return response()->json($schedules);
    }
}
