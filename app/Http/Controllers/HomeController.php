<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Attendance;
use App\ActivityLog;
use RealRashid\SweetAlert\Facades\Alert;
use Twilio\Rest\Client;


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
}
