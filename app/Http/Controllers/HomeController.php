<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use App\Attendance;
use App\ActivityLog;
use App\Appointment;
use App\Transaction;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = User::where('id',Auth::user()->id)->get();

        if($account[0]->otp == null || $account[0]->otp == ''){
            $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
            $permissions = [];
            foreach($user[0]->usertype->permissions as $permission)
            {
                array_push($permissions, $permission->name);
            }
            
            $data = array(
                'permissions' => $permissions,
                'user'        => $user
            );

            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Login'
            ]);

            return view('home')->with('data',$data);
        }else{
            
            if($account[0]->type == 3){
                return view('home_otp');
                
            }else{
                $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
                $permissions = [];
                foreach($user[0]->usertype->permissions as $permission)
                {
                    array_push($permissions, $permission->name);
                }
                
                $data = array(
                    'permissions' => $permissions,
                    'user'        => $user
                );

                ActivityLog::create([
                    'user_id' => Auth::user()->id,
                    'activity' => 'Login'
                ]);

                return view('home')->with('data',$data);
            }
            
        }
    }

    public function requestNewOtp(){
        $otp = random_int(100000, 999999);
        $user = User::where('id',Auth::user()->id)->get();
        $user[0]->otp = $otp;
        $user[0]->save();

        $this->sendMessage('Your Megason Diagnostic Clinics account was logged in. To proceed, ' . $user[0]->otp . ' is your OTP.', $user[0]->contact_number);
        Alert::success('', 'New OTP has been sent to your mobile number');
        return redirect('home');
    }

    public function validateOTP(Request $request){
        $user = User::where('id',Auth::user()->id)->get();
        if($user[0]->otp == $request->otp){
            $user[0]->otp = '';
            $user[0]->save();

            Alert::success('', 'OTP accepted!');
            return redirect('home');
        }else{
            Alert::error('', 'Invalid OTP');
            return redirect()->back();
        }

        
    }
    // public function overview()
    // {
    //     $today = Carbon::today();
    //     $week = Carbon::now()->startOfWeek();
    //     $month = Carbon::now()->startOfMonth();
    //     $year = Carbon::now()->startOfYear();
    
    //     // Breakdown for donut chart
    //     $breakdown = Appointment::select('specializations.name as label', DB::raw('COUNT(appointments.id) as value'))
    //         ->join('users', 'appointments.doctor_id', '=', 'users.id')
    //         ->join('doctor_details', 'users.id', '=', 'doctor_details.user_id')
    //         ->join('specializations', 'doctor_details.specialization_id', '=', 'specializations.id')
    //         ->groupBy('specializations.name')
    //         ->get();
    
    //     $breakdownLabels = [];
    //     $breakdownValues = [];
    //     foreach ($breakdown as $b) {
    //         $breakdownLabels[] = $b->label;
    //         $breakdownValues[] = $b->value;
    //     }
    
    //     // Monthly stats for Jan to Jun
    //     $bookedCounts = [];
    //     $cancelledCounts = [];
    //     for ($i = 1; $i <= 6; $i++) {
    //         $bookedCounts[] = Appointment::whereMonth('date', $i)->count();
    //         $cancelledCounts[] = Appointment::whereMonth('date', $i)->where('status', 2)->count();
    //     }
    
    //     // Upcoming appointments (next 7 days)
    //     $upcomingAppointments = Appointment::with(['doctor', 'user'])
    //         ->whereDate('date', '>=', $today)
    //         ->whereDate('date', '<=', $today->copy()->addDays(7))
    //         ->orderBy('date')
    //         ->take(5)
    //         ->get()
    //         ->map(function ($a) {
    //             return [
    //                 'name' => optional($a->user)->name ?? 'N/A',
    //                 'date' => $a->date ? Carbon::parse($a->date)->format('M d, Y') : 'N/A',
    //                 'time' => $a->real_time ?? 'N/A',
    //                 'doctor' => optional($a->doctor)->name ?? 'N/A',
    //             ];
    //         });
    
    //     // System logs (last 10 activities)
    //     $systemLogs = DB::table('activity_log') // change to your actual logs table
    //         ->latest()
    //         ->take(10)
    //         ->get()
    //         ->map(function ($log) {
    //             return [
    //                 'activity' => $log->activity,
    //                 'user' => optional(User::find($log->user_id))->name ?? 'System',
    //                 'created_at' => Carbon::parse($log->created_at)->diffForHumans(),
    //             ];
    //         });
    
    //     return response()->json([
    //         'stats' => [
    //             'all' => Appointment::count(),
    //             'today' => Appointment::whereDate('date', $today)->count(),
    //             'new' => Appointment::whereDate('created_at', $today)->count(),
    //             'cancelled' => Appointment::where('status', 2)->count(),
    //             'patients' => User::where('type', 3)->count(),
    //             'staff' => User::where('type', '!=', 3)->count(),
    //         ],
    //         'chart' => [
    //             'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    //             'datasets' => [
    //                 [
    //                     'label' => 'Booked',
    //                     'data' => $bookedCounts,
    //                     'borderColor' => '#007bff',
    //                     'backgroundColor' => 'transparent',
    //                     'tension' => 0.4,
    //                 ],
    //                 [
    //                     'label' => 'Cancelled',
    //                     'data' => $cancelledCounts,
    //                     'borderColor' => '#dc3545',
    //                     'backgroundColor' => 'transparent',
    //                     'tension' => 0.4,
    //                 ]
    //             ]
    //         ],
    //         'breakdown' => [
    //             'labels' => $breakdownLabels,
    //             'values' => $breakdownValues,
    //         ],
    //         'sales' => [
    //             Transaction::whereDate('created_at', $today)->where('status', 'paid')->sum('total_amount'),
    //             Transaction::where('created_at', '>=', $week)->where('status', 'paid')->sum('total_amount'),
    //             Transaction::where('created_at', '>=', $month)->where('status', 'paid')->sum('total_amount'),
    //             Transaction::where('created_at', '>=', $year)->where('status', 'paid')->sum('total_amount'),
    //         ],
    //         'recent_patients' => Appointment::with(['doctor', 'user'])
    //             ->latest()
    //             ->take(5)
    //             ->get()
    //             ->map(function ($a) {
    //                 return [
    //                     'name' => optional($a->user)->name ?? 'N/A',
    //                     'date' => $a->date ? Carbon::parse($a->date)->format('Y-m-d') : 'N/A',
    //                     'doctor' => optional($a->doctor)->name ?? 'N/A',
    //                 ];
    //             }),
    //         'upcoming_appointments' => $upcomingAppointments,
    //         'system_logs' => $systemLogs,
    //     ]);
    // }
    
    public function overview()
{
    $user = auth()->user();
    $today = Carbon::today();
    $week = Carbon::now()->startOfWeek();
    $month = Carbon::now()->startOfMonth();
    $year = Carbon::now()->startOfYear();

    $appointmentsQuery = Appointment::query();

    if ($user->type == 2) {
        $appointmentsQuery->where('doctor_id', $user->id);
    }

    // Breakdown
    $breakdown = Appointment::select('specializations.name as label', DB::raw('COUNT(appointments.id) as value'))
        ->join('users', 'appointments.doctor_id', '=', 'users.id')
        ->join('doctor_details', 'users.id', '=', 'doctor_details.user_id')
        ->join('specializations', 'doctor_details.specialization_id', '=', 'specializations.id');

    if ($user->type == 2) {
        $breakdown->where('appointments.doctor_id', $user->id);
    }

    $breakdownData = $breakdown->groupBy('specializations.name')->get();
    $breakdownLabels = $breakdownData->pluck('label')->toArray();
    $breakdownValues = $breakdownData->pluck('value')->toArray();

    // Monthly Stats
    $bookedCounts = [];
    $cancelledCounts = [];
    for ($i = 1; $i <= 6; $i++) {
        $bookedCounts[] = (clone $appointmentsQuery)->whereMonth('date', $i)->count();
        $cancelledCounts[] = (clone $appointmentsQuery)->whereMonth('date', $i)->where('status', 2)->count();
    }

    // Upcoming Appointments
    $upcomingAppointments = (clone $appointmentsQuery)
        ->with(['doctor', 'user'])
        ->whereDate('date', '>=', $today)
        ->whereDate('date', '<=', $today->copy()->addDays(7))
        ->orderBy('date')
        ->take(5)
        ->get()
        ->map(function ($a) {
            return [
                'name' => optional($a->user)->name ?? 'N/A',
                'date' => $a->date ? Carbon::parse($a->date)->format('M d, Y') : 'N/A',
                'time' => $a->real_time ?? 'N/A',
                'doctor' => optional($a->doctor)->name ?? 'N/A',
            ];
        });

    // System Logs (only for admin)
    $systemLogs = [];
    if ($user->type == 1) {
        $systemLogs = DB::table('activity_log')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($log) {
                return [
                    'activity' => $log->activity,
                    'user' => optional(User::find($log->user_id))->name ?? 'System',
                    'created_at' => Carbon::parse($log->created_at)->diffForHumans(),
                ];
            });
    }

    return response()->json([
        'stats' => [
            'all' => (clone $appointmentsQuery)->count(),
            'today' => (clone $appointmentsQuery)->whereDate('date', $today)->count(),
            'new' => (clone $appointmentsQuery)->whereDate('created_at', $today)->count(),
            'cancelled' => (clone $appointmentsQuery)->where('status', 2)->count(),
            'patients' => $user->type == 2 ? null : User::where('type', 3)->count(),
            'staff' => $user->type == 2 ? null : User::where('type', '!=', 3)->count(),
        ],
        'chart' => [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'datasets' => [
                [
                    'label' => 'Booked',
                    'data' => $bookedCounts,
                    'borderColor' => '#007bff',
                    'backgroundColor' => 'transparent',
                    'tension' => 0.4,
                ],
                [
                    'label' => 'Cancelled',
                    'data' => $cancelledCounts,
                    'borderColor' => '#dc3545',
                    'backgroundColor' => 'transparent',
                    'tension' => 0.4,
                ]
            ]
        ],
        'breakdown' => [
            'labels' => $breakdownLabels,
            'values' => $breakdownValues,
        ],
        'sales' => $user->type == 6 || $user->type == 7 || $user->type == 1 ? [
            Transaction::whereDate('created_at', $today)->where('status', 'paid')->sum('total_amount'),
            Transaction::where('created_at', '>=', $week)->where('status', 'paid')->sum('total_amount'),
            Transaction::where('created_at', '>=', $month)->where('status', 'paid')->sum('total_amount'),
            Transaction::where('created_at', '>=', $year)->where('status', 'paid')->sum('total_amount'),
        ] : [],
        'recent_patients' => [],
        'upcoming_appointments' => $upcomingAppointments,
        'system_logs' => $systemLogs,
    ]);
}


}
