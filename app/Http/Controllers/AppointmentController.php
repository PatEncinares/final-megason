<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use Carbon\Carbon;
use App\ActivityLog;
use App\Appointment;
use App\DoctorDetail;
use App\Transaction;
use App\PatientDetail;
use App\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentApprovalMail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\AppointmentCancellationMail;
use App\Mail\AppointmentConfirmationMail;
use App\Specialization;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->with('usertype', 'usertype.permissions')->get();
        $permissions = [];
        foreach ($user[0]->usertype->permissions as $permission) {
            array_push($permissions, $permission->name);
        }

        $data = array(
            'permissions' => $permissions,
        );

        return view('appointment.scheduler')->with('data', $data);
    }

    public function getList()
    {
        if (Auth::user()->type == 2) {
            // if doctor, show all schedules for the doctor
            return Appointment::where('doctor_id', Auth::user()->id)->with('doctor.doctorDetails', 'patient.patientDetails')->get();
        } else if (Auth::user()->type == 3) {
            // if patient, show all schedules for the patient
            return Appointment::where('user_id', Auth::user()->id)->with('doctor.doctorDetails', 'patient.patientDetails')->get();
        } else {
            // if others = get all appointments
            return Appointment::with('doctor.doctorDetails', 'patient.patientDetails')->get();
        }
    }

    // public function saveAppointment(Request $request){
    //    // check appointment avaialability
    // //    dd($request->all());

    //    $time_data = date('A',strtotime($request->real_time));
    // //    dd($time_data);
    //    $schedule = Appointment::where('date','=',$request->date)
    //    ->where('time','=',$time_data)
    //     ->where(function ($query) use ($time_data) {
    //         $query->where('status','=',1)
    //         ->orwhere('status','=',0);
    //     })
    // //    ->where('status','=',1) // approved appointment
    //    ->count();

    //     // dd($schedule);


    //     $sameTimeDoctor = Appointment::where('date','=',$request->date)
    //         ->where("doctor_id",$request->doctor_id)
    //         ->where('user_id',$request->patient_id)
    //         ->where(function ($query) use ($request) {
    //             $query->where('time','=',$request->time)
    //             ->orwhere('real_time','=',$request->real_time);
    //         })
    //         ->count();

    //     $settings = Setting::find(1);
    //     $limit = ($request->time == 'AM') ? $settings->am_limit : $settings->pm_limit;


    //     // validate date
    //     $today = Carbon::today();
    //     $date  = Carbon::parse($request->date);
    //     $time_open  = Carbon::createFromTimeString('09:00');
    //     $time_close = Carbon::createFromTimeString('17:00');

    //     if($date->lessThan($today)){
    //         Alert::error('', 'Please select date ahead from today');
    //         return redirect()->back()->withInput(); 
    //     }
    //     else{
    //         if(!Carbon::parse($request->real_time)->between($time_open, $time_close)){
    //             Alert::error('', 'Please select time between 9:00AM to 5:00PM');
    //             return redirect()->back()->withInput(); 
    //         }else{
    //             if($schedule >= $limit){
    //                 // no slots left for your selected schedule
    //                 Alert::error('', 'No slots left for your selected schedule');
    //                 return redirect()->back()->withInput(); 
    //             }
    //             else if($sameTimeDoctor > 0){
    //                 Alert::error('', 'You already have an appointment with the same doctor and same schedule!');
    //                 return redirect()->back()->withInput(); 
    //             }
    //             else{
    //                 $appointment = Appointment::create([
    //                     'doctor_id' => $request->doctor_id,
    //                     'user_id'   => $request->patient_id,
    //                     'date'      => $request->date,
    //                     'real_time' => $request->real_time,
    //                     'time'      => $time_data,
    //                     'status'    => 0, // not yet approved
    //                 ]);

    //                 ActivityLog::create([
    //                     'user_id' => Auth::user()->id,
    //                     'activity' => 'Created an Appointment'
    //                 ]);

    //                 Alert::success('', 'Appointment saved');
    //                 return redirect()->route('appointment');
    //             }
    //         }
    //     }


    // }

    public function saveAppointment(Request $request)
    {
   
        // Get AM/PM time format
        $time_data = date('A', strtotime($request->real_time));

        // Prevent booking the same doctor at the same time & date (by any user)
        $doctorAlreadyBooked = Appointment::where('date', '=', $request->date)
            ->where('real_time', '=', $request->real_time)
            ->where('doctor_id', '=', $request->doctor_id)
            ->where(function ($query) {
                $query->where('status', '=', 1) // Approved
                    ->orWhere('status', '=', 0); // Pending
            })
            ->exists();

        // Prevent the same user from booking a different doctor at the same time & date
        // $userDoubleBooking = Appointment::where('date', '=', $request->date)
        //     ->where('real_time', '=', $request->real_time)
        //     ->where('user_id', '=', $request->patient_id)
        //     ->where('doctor_id', '!=', $request->doctor_id) // Different doctor
        //     ->exists();
        // Prevent the same user from booking the same doctor on the same date
        $userDoubleBooking = Appointment::where('date', '=', $request->date)
        ->where('doctor_id', '=', $request->doctor_id)
        ->where('user_id', '=', $request->patient_id)
        ->exists();


        // Get appointment limits from settings
        $settings = Setting::find(1);
        $limit = ($request->time == 'AM') ? $settings->am_limit : $settings->pm_limit;

        // Validate date and time
        $today = Carbon::today();
        $date = Carbon::parse($request->date);
        $time_open = Carbon::createFromTimeString('09:00');
        $time_close = Carbon::createFromTimeString('17:00');

        if ($date->lessThan($today)) {
            Alert::error('', 'Please select a date ahead of today');
            return redirect()->back()->withInput();
        } elseif (!Carbon::parse($request->real_time)->between($time_open, $time_close)) {
            Alert::error('', 'Please select a time between 9:00 AM to 5:00 PM');
            return redirect()->back()->withInput();
        } elseif ($doctorAlreadyBooked) {
            Alert::error('', 'This doctor is already booked at this date and time.');
            return redirect()->back()->withInput();
        } elseif ($userDoubleBooking) {
            Alert::error('', 'You already have an appointment with this doctor on the selected date.');
            return redirect()->back()->withInput();
        } else {
            // Save appointment
            $appointment = Appointment::create([
                'doctor_id' => $request->doctor_id,
                'user_id'   => $request->patient_id,
                'date'      => $request->date,
                'real_time' => $request->real_time,
                'time'      => $time_data,
                'status'    => 0, // Not yet approved
            ]);

            $user = User::where('id', $request->patient_id)->first();
            // dd($appointment);
            if (!$user) {
                Alert::error('', 'Unable to send confirmation email. Patient not found.');
            } else {
                Mail::to($user->email)->send(new AppointmentConfirmationMail($appointment, $user));
            }

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Created an Appointment'
            ]);

            Alert::success('', 'Appointment saved');
            return redirect()->route('appointment');
        }
    }

    public function checkAvailability(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->with('usertype', 'usertype.permissions')->get();
        $permissions = [];
        foreach ($user[0]->usertype->permissions as $permission) {
            array_push($permissions, $permission->name);
        }

        $doctors = User::where('type', '=', 2)->with('doctorDetails')->get();

        $data = array(
            'permissions' => $permissions,
            'doctors'     => $doctors
        );

        return view('appointment.check_availability')->with('data', $data);
    }

    public function checkSchedule(Request $request)
    {
        $am_limit = Setting::all()[0]->am_limit;
        $pm_limit = Setting::all()[0]->pm_limit;

        $schedule = Appointment::where('doctor_id', '=', $request->doctor_id)
            ->where('date', '=', $request->date)
            ->where('time', '=', $request->period)
            ->where('status', '=', 1) // approved appointment
            ->get();

        if ($request->period == 'AM') {
            if ($schedule->count() >= $am_limit) {
                Alert::error('', 'Schedule not available');
            } else {
                Alert::success('', 'Schedule available');
            }
        } else if ($request->period == 'PM') {
            if ($schedule->count() >= $pm_limit) {
                Alert::error('', 'Schedule not available');
            } else {
                Alert::success('', 'Schedule available');
            }
        }

        return redirect()->back();
    }

    public function create()
    {
        $user = User::where('id', Auth::user()->id)->with('usertype', 'usertype.permissions')->get();
        $permissions = [];
        foreach ($user[0]->usertype->permissions as $permission) {
            array_push($permissions, $permission->name);
        }

        $doctors = User::where('type', '=', 2)->with('doctorDetails')->get();
        $patients = User::where('type', '=', 3)->with('patientDetails')->get();
        $specializations = Specialization::all();

        $data = array(
            'permissions' => $permissions,
            'doctors'     => $doctors,
            'patients'    => $patients,
            'specializations' => $specializations
        );

        return view('appointment.create')->with('data', $data);
    }

    public function view(Request $request)
    {
        $appointment = Appointment::where('id', '=', $request->id)->with('doctor', 'patient')->get()->toArray();
        // $transaction = Transaction::where('patient_id', '=', $appointment[0]['user_id'])
        //                             ->where('doctor_id','=', $appointment[0]['doctor_id'])
        //                             ->where('schedule_id','=',$appointment[0]['id'])
        //                             ->get()
        //                             ->toArray();

        $user = User::where('id', Auth::user()->id)->with('usertype', 'usertype.permissions')->get();
        $permissions = [];
        foreach ($user[0]->usertype->permissions as $permission) {
            array_push($permissions, $permission->name);
        }


        $data = array(
            'permissions' => $permissions,
            'appointments'     => $appointment[0]
        );
        return view('appointment.view')->with('data', $data);
    }

    public function approve(Request $request)
    {
        $appointment = Appointment::where('id', $request->id)->first();
        $user = User::where('id', $appointment->user_id)->first();
    
        // Safety check
        if (!$appointment || !$user) {
            Alert::error('', 'Unable to approve appointment. Appointment or user not found.');
            return redirect()->back();
        }
    
        $appointment->status = 1; // Approved
        $appointment->save();
    
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Approved an appointment'
        ]);
    
        // Send approval email
        Mail::to($user->email)->send(new AppointmentApprovalMail($appointment, $user));
    
        Alert::success('', 'Appointment approved');
        return redirect()->back();
    }

    public function cancel(Request $request)
    {

        $appointment = Appointment::where('id', $request->id)->first();
        $user = User::where('id', $appointment->user_id)->first();
    
        // Safety check in case appointment or user is not found
        if (!$appointment || !$user) {
            Alert::error('', 'Unable to cancel appointment. Appointment or user not found.');
            return redirect()->back();
        }
    
        $appointment->status = 2;
        $appointment->save();
    
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Canceled an Appointment'
        ]);
    
        // Send cancellation email
        Mail::to($user->email)->send(new AppointmentCancellationMail($appointment, $user));
    
        Alert::success('', 'Appointment canceled');
        return redirect()->back();
    }


     public function getDoctorSchedule($id)
    {
        // return DoctorSchedule::where('doctor_id', $id)->get();

        return DoctorSchedule::where('doctor_id', $id)->get()->map(function ($schedule) {
            return [
                'day_of_week' => $schedule->day_of_week,
                'start_time' => substr($schedule->start_time, 0, 5),
                'end_time' => substr($schedule->end_time, 0, 5),
            ];
        });
    }

    public function getDoctorAvailability($doctorId, $date)
    {
        $dayName = Carbon::parse($date)->format('l'); // e.g., "Monday"

        // Find the doctor's schedule for that day
        $schedule = DoctorSchedule::where('doctor_id', $doctorId)
            ->where('day_of_week', $dayName)
            ->first();

        if (!$schedule) {
            return response()->json(['available' => false]);
        }

        // Count how many appointments already exist on that date
        $appointmentCount = Appointment::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->where('status', '!=', 'cancelled') // Adjust this field name if needed
            ->count();

        return response()->json([
            'available' => true,
            'start_time' => substr($schedule->start_time, 0, 5),
            'end_time' => substr($schedule->end_time, 0, 5),
            'max_patients' => $schedule->max_patients,
            'current_booked' => $appointmentCount,
            'remaining_slots' => max($schedule->max_patients - $appointmentCount, 0),
        ]);
    }

    public function getDoctorsBySpecialization($id)
{
    $doctors = DoctorDetail::where('specialization_id', $id)
        ->get(['user_id as id', 'fullname']);

    return response()->json($doctors);
}


}
