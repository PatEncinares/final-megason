<?php

namespace App\Http\Controllers;
use Mail;
use App\User;
use App\Employee;
use App\UserType;
use Carbon\Carbon;
use App\ActivityLog;
use App\DoctorDetail;
use App\PatientDetail;
use App\Mail\UserCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function list(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $users = User::with('usertype')->get();
        $data = array(
            'permissions' => $permissions,
            'users'       => $users,
        );

        return view('users.list')->with('data',$data);
    }

    public function create(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $types = UserType::all();
        $data = array(
            'permissions' => $permissions,
            'types'       => $types
        );

        return view('users.create')->with('data',$data);
    }

    public function save(Request $request){
        // create user
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'contact_number' => [
                'required',
                'regex:/^(\+)(\d{12})$/',
                'max:13'
            ],
            'user_type' => 'required|in:admin,doctor,staff', // adjust values to your actual roles
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a valid string.',
            'name.regex' => 'Name must only contain letters and spaces.',
        
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email already exists in the system.',
        
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex' => 'Invalid phone number format. Use format like +639123456789.',
            'contact_number.max' => 'Phone number must be 13 characters max, including +63 prefix.',
        
            'user_type.required' => 'User type is required.',
            'user_type.in' => 'User type must be one of the following: admin, doctor, or staff.',
        ]);
        


        $tempPass = substr(str_shuffle(uniqid()), 0, 6);
        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'password' => Hash::make($tempPass),
            'type'  => $request->user_type,
        ]);

        if($user->type == '3')
        {
            // add patient details
            PatientDetail::create([
                'user_id' => $user->id,
            ]);
        }else if($user->type == '2'){
            // add doctor details
            DoctorDetail::create([
                'user_id' => $user->id,
                'fullname' => $user->name
            ]);
        }

        if($user->type != 1 && $user->type != 3){
            // create employee record if not admin and patient
            $newEmployee = Employee::create([
                'user_id' => $user->id
            ]);
        }

        //mail credentials
        $data = [
            'user'      => $user,
            'tempPass'  => $tempPass
        ];
        // Mail::to($user->email)->send(new \App\Mail\UserCreated($data));
        Mail::to($user->email)->send(new UserCreated($data));

        // Mail::to($user->email)->send(new TemporaryPasswordMail($user, $tempPassword));

        Alert::success('User Created!', 'A temporary password has been sent to the email address of the new user');
        
        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Created a new User account'
        ]);

        return redirect()->route('user-list');
    } 

    public function edit(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }
        $toEdit = User::where('id','=',$request->id)->with('usertype')->get();

        $types = UserType::all();
        $data = array(
            'permissions' => $permissions,
            'types'       => $types,
            'toEdit'      => $toEdit
        );

        return view('users.edit')->with('data',$data);
    }

    public function update(Request $request){
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id,
            'contact_number' => [
                'required',
                'regex:/^(\+)(\d{12})$/',
                'max:13'
            ],
            // 'user_type' => 'required|in:admin,doctor,staff', // adjust values to your actual roles
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a valid string.',
            'name.regex' => 'Name must only contain letters and spaces.',
        
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email already exists in the system.',
        
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex' => 'Invalid phone number format. Use format like +639123456789.',
            'contact_number.max' => 'Phone number must be 13 characters max, including +63 prefix.',
        
            // 'user_type.required' => 'User type is required.',
            // 'user_type.in' => 'User type must be one of the following: admin, doctor, or staff.',
        ]);
        
        $user = User::where('id','=',$request->user_id)->get();

        if($user[0]->type == '2'){ // if type is doctor
            if($request->user_type == '3'){
                // if new type is patient, delete doctor detail and create patient details
                $doctorDetail = DoctorDetail::where('user_id','=',$user[0]->id)->get();
                $doctorDetail[0]->delete();
                $patientDetail = PatientDetail::create([
                    'user_id' => $user[0]->id
                ]);
            }else if($request->user_type == '2'){ // if type is still doctor
                // do nothing
            }else{  // if type to change is others
                $doctorDetail = DoctorDetail::where('user_id','=',$user[0]->id)->get();
                $doctorDetail[0]->delete();
            }
        }else if($user[0]->type == '3'){ // if type is patient
            if($request->user_type == '2'){ // if new type is doctor
                $patientDetail = PatientDetail::where('user_id','=',$user[0]->id)->get();
                $patientDetail[0]->delete();
                $doctorDetail = DoctorDetail::create([
                    'user_id' => $user[0]->id
                ]);
            }else if($request->user_type == '3'){ // if new type is still patient
                // do nothing
            }else{
                $patientDetail = PatientDetail::where('user_id','=',$user[0]->id)->get();
                $patientDetail[0]->delete();
            }
        }
        $tempPass = str_shuffle($this->rand_str());

        $user[0]->name = $request->name;
        $user[0]->email = $request->email;
        $user[0]->contact_number = $request->contact_number;
        $user[0]->type = $request->user_type;
        $user[0]->password = Hash::make($tempPass);
        $user[0]->save();

        //mail credentials
        $data = [
            'user'      => $user[0],
            'tempPass'  => $tempPass
        ];
        // Mail::to($user[0]->email)->send(new \App\Mail\UserCreated($data));

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated a User account'
        ]);

        Alert::success('User Updated!');
        return redirect()->route('user-list');
    }

    public function rand_str() {
        $numbers = '0123456789';
        $specials   = '-=+{}[]:;@#~.?/&gt;,&lt;|\!"£$%^&amp;*()';
        $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomstr = '';
        for ($i = 0; $i < 2; $i++) {
            $randomstr .= $alpha[random_int(0, 52)];
        }
        for ($i = 0; $i < 2; $i++) {
            $randomstr .= $specials[random_int(0, 40)];
        }
        for ($i = 0; $i < 3; $i++) {
            $randomstr .= $numbers[random_int(0, 10)];
        }

        return $randomstr;
    }

    public function delete(Request $request){
        $user = User::where('id','=',$request->id)->get();
        $user[0]->delete();

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Deleted a user account'
        ]);

        Alert::success('', 'User Deleted!');
        return redirect()->route('user-list');

    }

    public function profile(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        if(Auth::user()->type == '2') { //doctor
            $profile = User::where('id','=',Auth::user()->id)->with('usertype','doctorDetails')->get();
        }else if(Auth::user()->type == '3'){ // patient
            $profile = User::where('id','=',Auth::user()->id)->with('usertype','patientDetails')->get();
        }
        $data = array(
            'permissions' => $permissions,
            'profile'     => $profile            
        );

        if(Auth::user()->type == '2') { //doctor
            return view('users.doctor_profile')->with('data',$data);
        }else if(Auth::user()->type == '3'){ // patient
            return view('users.patient_profile')->with('data',$data);
        }
    }

    public function changePassword(Request $request){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $data = array(
            'permissions' => $permissions,
            'user'     => $user,
        );

        return view('users.new_password')->with('data', $data);
    }

    public function savePassword(Request $request){
        $validate = $request->validate([
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ], [
            'regex' => 'Password must contain atleast one (1) Uppercase, Lowercase, Special Character and a Number.',
        ]);
        $user_id = (int)$request->user_id;
        
        $user = User::where('id', $user_id)->update([
            'password' => Hash::make($request->password)
        ]);        
        // $user->password = Hash::make($request->password);

        ActivityLog::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Updated password'
        ]);

        Alert::success('', 'Password Updated!');
        return redirect()->back();
    }

    public function getActivities(){
        $user = User::where('id', Auth::user()->id)->with('usertype','usertype.permissions')->get();
        $permissions = [];
        $activities = ActivityLog::with('user')->get();
        foreach($user[0]->usertype->permissions as $permission)
        {
            array_push($permissions, $permission->name);
        }

        $data = array(
            'permissions' => $permissions,
            'activities' => $activities
        );

        return view('users.activity_log')->with('data', $data);
    }
}
