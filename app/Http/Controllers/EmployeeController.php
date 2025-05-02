<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use App\Employee;
use App\User;
use App\Attendance;
use App\Payroll;
use Carbon\Carbon;
use App\ActivityLog;

class EmployeeController extends Controller
{
    public function getList(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $employees = Employee::with('user','user.usertype')->get();

        $data = array(
            'permissions' => $permissions,
            'employees'   =>   $employees
        );

        
        return view('employees.list')->with('data',$data);
    }

    public function timesheet(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $employee = Employee::where('id','=',$request->id)->with('user','user.usertype')->get();
        $timesheet = Attendance::where('employee_id','=',$employee[0]->id)->get();
        $workdays = [];
        // check if current date is on first half of the month
        $firstDay = Carbon::now()->firstOfMonth();
        $fifteenthDay = Carbon::now()->firstOfMonth()->addDays(14);
        $lastDay = Carbon::now()->endOfMonth();
        $payPeriod = 0;
       

        if(Carbon::now()->between($firstDay, $fifteenthDay)){
            $payPeriod = 1;
            foreach($timesheet as $attendance)
            {
                if(Carbon::parse($attendance->date)->between($firstDay,$fifteenthDay)){
                    array_push($workdays,$attendance);
                }
            }
        }else{
            $payPeriod = 2;
            foreach($timesheet as $attendance)
            {
                if(Carbon::parse($attendance->date)->between($fifteenthDay,$lastDay)){
                    array_push($workdays,$attendance);
                }
            }
        }
        
        $total_workdays = 0;
        $total_hours_worked = 0;
        $date_worked = [];
        foreach($workdays as $workday){
            array_push($date_worked, $workday->date);
        }
        // dd($workdays);

        $dates = array_unique($date_worked);
        $workingdays = [];
        foreach($date_worked as $date){
            foreach($workdays as $workday){
                
                if($date == $workday->date && $workday->type == 'IN'){
                    // $start_time = Carbon::parse($workday->time);
                    $workingdays[$date]['IN'] = Carbon::parse($workday->time);
                }
                if($date == $workday->date && $workday->type == 'OUT'){
                    $workingdays[$date]['OUT'] = Carbon::parse($workday->time);
                }
            }
            if(!array_key_exists('OUT', $workingdays[$date])){
                $workingdays[$date]['OUT'] = '';
                $workingdays[$date]['hourswork'] = 0;
            }else if(!array_key_exists('IN', $workingdays[$date])){
                $workingdays[$date]['IN'] = '';
                $workingdays[$date]['hourswork'] = 0;
            }else{
                $workingdays[$date]['hourswork'] = $workingdays[$date]['IN']->diffInHours($workingdays[$date]['OUT'],false);
            }
            
        }

        foreach($workingdays as $date => $value){
            if($value['IN'] == '' || $value['OUT'] == ''){
                // don't count if there's no in or out
            }else{
                $total_hours_worked = $total_hours_worked + $value['IN']->diffInHours($value['OUT'],false);
            }
        }

        $period = ($payPeriod == 1) ? $firstDay->format('M d, Y') . ' - ' . $fifteenthDay->format('M d, Y') : Carbon::now()->firstOfMonth()->addDays(15)->format('M d, Y') . ' - ' . $lastDay->format('M d, Y');
        $check = Payroll::where('pay_period','=',$period)->where('employee_id','=',$employee[0]->id)->count();
        // dd($check);
     

        $data = array(
            'permissions' => $permissions,
            'employee'    => $employee,
            'workdays'    => $workingdays,
            'pay_period'  => $period,
            'total_hours_worked' => $total_hours_worked,
            'total_days_worked'  => count($dates),
            'payroll_generated'  => ($check > 0) ? 'true' : 'false',
        );

        // dd($data);
        return view('employees.timesheet')->with('data',$data);
    }

    public function savePayroll(Request $request){
        $employee = Employee::where('id','=',$request->employee_id)->with('user','user.usertype')->get();
        $daily_rate = $employee[0]->daily_rate;
        $hourly_rate = $daily_rate/8;
        $total_pay = $hourly_rate * $request->total_hours_worked;
        $leave = (int)$request->employee_leave * $daily_rate;
        $ot = $hourly_rate * $request->ot;
        $tmonth = ($daily_rate * $request->tmonth) / 12;
        $rholiday = ($daily_rate * $request->rholiday);
        $sholiday = ($daily_rate * $request->holiday) * .3;
        $sss = $daily_rate * (double)$request->sss;
        $philhealth = $daily_rate * (double)$request->philhealth;
        $tax =  $daily_rate * (double)$request->tax;
        $gross_pay = $total_pay + $leave + $ot + $tmonth + $rholiday + $sholiday + $request->bonus;
        $total_deductions = $sss + $philhealth + (double)$request->pagibig + $tax;
        $net_pay = $total_pay - $total_deductions + $leave + $ot + $tmonth + $request->bonus + $rholiday + $sholiday;


        $payroll = Payroll::create([
            'employee_id'        => $request->employee_id,
            'pay_period'         => $request->pay_period,
            'total_hours_worked' => $request->total_hours_worked,
            'total_days_worked'  => $request->total_days_worked,
            'employee_leave'     => $request->employee_leave,
            'ot'                 => $request->ot,
            'rholiday'           => $request->rholiday,
            'sholiday'           => $request->sholiday,
            'tmonth'             => $request->tmonth,
            'bonus'              => $request->bonus,
            'gross_pay'          => $gross_pay,
            'sss'                => $request->sss,
            'philhealth'         => $request->philhealth,
            'pagibig'            => $request->pagibig,
            'tax'                => $request->tax,
            'total_deduction'    => $total_deductions,
            'total_pay'          => $total_pay,
            'net_pay'            => $net_pay
        ]);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Generated a payroll'
        ]);

        Alert::success('', 'Timesheet submitted, payroll has been generated');
        return redirect()->route('get-payroll',['id' => $payroll->id]);
    }

    public function getPayroll(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $payroll = Payroll::where('id','=',$request->id)->with('employee','employee.user','employee.user.usertype')->get();

        $data = array(
            'permissions' => $permissions,
            'payroll'   =>   $payroll
        );

        
        return view('payroll.view')->with('data',$data);
    }

    public function payrollList(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $payroll = Payroll::with('employee','employee.user','employee.user.usertype')->get();

        $data = array(
            'permissions' => $permissions,
            'payroll'   =>   $payroll
        );

        // dd($data);
        return view('payroll.list')->with('data',$data);
    }

    public function editDailyRate(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $employee = Employee::where('id', $request->id)->with('user')->get();

        $data = array(
            'permissions' => $permissions,
            'employee'   =>   $employee
        );

        // dd($data);
        return view('employees.edit_daily_rate')->with('data',$data);
    }

    public function saveDailyRate(Request $request){
        $employee = Employee::where('id',$request->employee_id)->get();
        $employee[0]->daily_rate = $request->daily_rate;
        $employee[0]->save();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated a daily rate of an employee'
        ]);

        Alert::success('', 'Daily Rate Updated!');
        return redirect()->route('get-employees-list');
    }

    public function timeIn(){
        $user = User::where('id',Auth::user()->id)->with('employeeDetails')->get();
        $employee = Employee::where('user_id', Auth::user()->id)->get();

        $date_now = Carbon::now()->format('Y-m-d');
        $time_now = Carbon::now()->format('H:m');
        // check if time in exists for the day
        $attendance = Attendance::where('employee_id', $employee[0]->id)
                                ->where('date',$date_now)
                                ->where('type', 'IN')
                                ->get()
                                ->count();
        
        if($attendance > 0){
            // may time in na
            Alert::error('', 'You already have time in for today!');
            return redirect()->back();
        }else{
            Attendance::create([
                'employee_id' => $employee[0]->id,
                'date'        => $date_now,
                'time'        => $time_now,
                'type'        => "IN"
            ]);

            ActivityLog::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Submitted an attendance time-in'
            ]);

            Alert::success('', 'Time in recorded at ' . Carbon::now()->format('g:i A') . '!');
            return redirect()->back();
        }
    }

    public function timeOut(){
        $user = User::where('id',Auth::user()->id)->with('employeeDetails')->get();
        $employee = Employee::where('user_id', Auth::user()->id)->get();

        $date_now = Carbon::now()->format('Y-m-d');
        $time_now = Carbon::now()->format('H:m');
        // check if time in exists for the day
        $timeIn = Attendance::where('employee_id', $employee[0]->id)
                                ->where('date',$date_now)
                                ->where('type', 'IN')
                                ->get()
                                ->count();
        // check if time out exists for the day
        $timeOut = Attendance::where('employee_id', $employee[0]->id)
                                ->where('date',$date_now)
                                ->where('type', 'OUT')
                                ->get()
                                ->count();

        if($timeOut > 0){
            // may out na
            Alert::error('', 'You already have time out for today!');
            return redirect()->back();
        }else{
            if($timeIn > 0){
                // may time in na
                Attendance::create([
                    'employee_id' => $employee[0]->id,
                    'date'        => $date_now,
                    'time'        => $time_now,
                    'type'        => "OUT"
                ]);

                ActivityLog::create([
                    'user_id' => Auth::user()->id,
                    'activity' => 'Submitted an attendance time-out'
                ]);
    
                Alert::success('', 'Time out recorded at ' . Carbon::now()->format('g:i A') . '!');
                return redirect()->back();
            }else{
                // wala pa IN
                Alert::error('', 'Please time in first!');
                return redirect()->back();
            }
        }
        
    }
}
